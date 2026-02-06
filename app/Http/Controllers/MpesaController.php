<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;

class MpesaController extends Controller
{
    /* =======================
     |  BASE URL
     ======================= */
    private function baseUrl(): string
    {
        return env('MPESA_ENV') === 'production'
            ? 'https://api.safaricom.co.ke'
            : 'https://sandbox.safaricom.co.ke';
    }

    /* =======================
     |  ACCESS TOKEN
     ======================= */
    private function accessToken(): string
    {
        $res = Http::timeout(10)
            ->withBasicAuth(
                env('MPESA_CONSUMER_KEY'),
                env('MPESA_CONSUMER_SECRET')
            )
            ->get($this->baseUrl() . '/oauth/v1/generate?grant_type=client_credentials');

        if (!$res->ok()) {
            Log::error('MPESA TOKEN ERROR', ['body' => $res->body()]);
            throw new \Exception('Failed to get access token');
        }

        return $res->json()['access_token'];
    }

    /* =======================
     |  STK PASSWORD
     ======================= */
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
                Log::error('STK HTTP ERROR', ['body' => $res->body()]);
                return response()->json(['message' => 'STK failed'], 502);
            }

            $json = $res->json();

            Payment::create([
                'merchant_request_id' => $json['MerchantRequestID'] ?? '',
                'checkout_request_id' => $json['CheckoutRequestID'] ?? '',
                'amount' => $data['amount'],
                'phone'  => $data['phone'],
            ]);

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

        $payment = Payment::where(
            'checkout_request_id',
            $cb['CheckoutRequestID'] ?? ''
        )->first();

        if ($payment) {
            $payment->result_code = (string)($cb['ResultCode'] ?? '');
            $payment->result_desc = $cb['ResultDesc'] ?? '';

            if ((string)$cb['ResultCode'] === "0") {
                foreach ($cb['CallbackMetadata']['Item'] as $item) {
                    if ($item['Name'] === 'MpesaReceiptNumber') {
                        $payment->mpesa_receipt_number = $item['Value'];
                    }
                    if ($item['Name'] === 'TransactionDate') {
                        $payment->transaction_date = $item['Value'];
                    }
                }
            }

            $payment->raw_payload = $request->all();
            $payment->save();
        }

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Processed']);
    }

    /* =======================
     |  CHECK STATUS
     ======================= */
    public function checkStatus($checkoutRequestId)
    {
        $payment = Payment::where('checkout_request_id', $checkoutRequestId)->first();

        if (!$payment) {
            return response()->json(['status' => 'pending']);
        }

        return response()->json([
            'status' => $payment->result_code === "0"
                ? 'success'
                : ($payment->result_code === null ? 'pending' : 'failed'),
            'payment' => $payment
        ]);
    }
}
