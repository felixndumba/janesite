<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class MpesaController extends Controller
{
    private function baseUrl(): string
    {
        return env('MPESA_ENV') === 'production'
            ? 'https://api.safaricom.co.ke'
            : 'https://sandbox.safaricom.co.ke';
    }

    private function accessToken(): string
    {
        $res = Http::timeout(10)
            ->withBasicAuth(
                env('MPESA_CONSUMER_KEY'),
                env('MPESA_CONSUMER_SECRET')
            )
            ->get($this->baseUrl() . '/oauth/v1/generate?grant_type=client_credentials');

        if (!$res->ok()) {
            throw new \Exception('Failed to get access token');
        }

        return $res->json()['access_token'];
    }

    private function stkPassword(string $timestamp): string
    {
        return base64_encode(
            env('MPESA_SHORTCODE') .
            env('MPESA_PASSKEY') .
            $timestamp
        );
    }

    /* =======================
     |  STK PUSH INITIATE
     ======================= */
    public function stkPush(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:1',
            'phone'  => 'required|regex:/^2547\d{8}$/'
        ]);

        $timestamp = now()->format('YmdHis');

        $payload = [
            "BusinessShortCode" => env('MPESA_SHORTCODE'),
            "Password"          => $this->stkPassword($timestamp),
            "Timestamp"         => $timestamp,
            "TransactionType"   => "CustomerBuyGoodsOnline",
            "Amount"            => (int)$data['amount'],
            "PartyA"            => $data['phone'],
            "PartyB"            => env('MPESA_TILL_NUMBER'),
            "PhoneNumber"       => $data['phone'],
            "CallBackURL"       => env('MPESA_CALLBACK_URL'),
            "AccountReference"  => "Payment",
            "TransactionDesc"   => "Payment"
        ];

        try {
            $res = Http::timeout(10)
                ->withToken($this->accessToken())
                ->post($this->baseUrl() . '/mpesa/stkpush/v1/processrequest', $payload);

            if (!$res->ok()) {
                Log::error('STK HTTP Error', ['body' => $res->body()]);
                return response()->json(['message' => 'STK failed'], 502);
            }

            $json = $res->json();

            // Store temporary status in cache (10 minutes)
            Cache::put(
                'stk_' . $json['CheckoutRequestID'],
                ['status' => 'pending'],
                now()->addMinutes(10)
            );

            return response()->json([
                'status' => 'pending',
                'checkout_request_id' => $json['CheckoutRequestID']
            ]);

        } catch (\Throwable $e) {
            Log::error('STK ERROR', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Server error'], 500);
        }
    }

    /* =======================
     |  STK CALLBACK
     ======================= */
    public function stkCallback(Request $request)
    {
        $cb = $request->input('Body.stkCallback');

        if (!$cb) {
            return response()->json(['ResultCode' => 0, 'ResultDesc' => 'OK']);
        }

        $checkoutId = $cb['CheckoutRequestID'] ?? null;

        if ($checkoutId) {
            Cache::put(
                'stk_' . $checkoutId,
                [
                    'status' => ((string)$cb['ResultCode'] === "0") ? 'success' : 'failed',
                    'result_desc' => $cb['ResultDesc'] ?? '',
                    'payload' => $request->all()
                ],
                now()->addMinutes(10)
            );
        }

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Processed']);
    }

    /* =======================
     |  CHECK STATUS
     ======================= */
    public function checkStatus($checkoutRequestId)
    {
        return response()->json(
            Cache::get('stk_' . $checkoutRequestId, ['status' => 'pending'])
        );
    }
}
