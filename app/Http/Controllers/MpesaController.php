<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;

class MpesaController extends Controller
{
    /* ================= BASE URL ================= */

    private function baseUrl(): string
    {
        return config('services.env') === 'production'
            ? 'https://api.safaricom.co.ke'
            : 'https://sandbox.safaricom.co.ke';
    }

    /* ================= ACCESS TOKEN ================= */

    private function accessToken(): string
    {
        $key    = config('services.consumer_key');
        $secret = config('services.consumer_secret');

        $res = Http::withBasicAuth($key, $secret)
            ->get($this->baseUrl() . '/oauth/v1/generate?grant_type=client_credentials');

        if (!$res->ok()) {
            Log::error('MPESA TOKEN ERROR', $res->json());
            abort(500, 'Failed to obtain M-Pesa token');
        }

        return $res->json()['access_token'];
    }

    /* ================= PASSWORD ================= */

    private function password(string $shortcode, string $passkey, string $timestamp): string
    {
        return base64_encode($shortcode . $passkey . $timestamp);
    }

    /* ================= STK PUSH ================= */

    public function stkPush(Request $request)
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            'phone'  => ['required', 'regex:/^2547\d{8}$/'],
            'account_reference' => ['nullable', 'string', 'max:20'],
            'description'       => ['nullable', 'string', 'max:60'],
        ]);

        $shortcode = config('services.shortcode');
        $till      = config('services.till');
        $passkey   = config('services.passkey');

        $timestamp = now()->format('YmdHis');
        $password  = $this->password($shortcode, $passkey, $timestamp);

        $payload = [
            "BusinessShortCode" => $shortcode,
            "Password"          => $password,
            "Timestamp"         => $timestamp,
            "TransactionType"   => "CustomerBuyGoodsOnline",
            "Amount"            => (int) $data['amount'],
            "PartyA"            => $data['phone'],
            "PartyB"            => $till,
            "PhoneNumber"       => $data['phone'],
            "CallBackURL"       => config('services.callback_url'),
            "AccountReference"  => $data['account_reference'] ?? 'ORDER',
            "TransactionDesc"   => $data['description'] ?? 'Payment'
        ];

        $response = Http::withToken($this->accessToken())
            ->post($this->baseUrl() . '/mpesa/stkpush/v1/processrequest', $payload);

        $json = $response->json();

        Log::info('MPESA STK REQUEST', $payload);
        Log::info('MPESA STK RESPONSE', $json);

        /**
         * ✅ SUCCESS CONDITION
         * ResponseCode === "0"
         */
        if (
            isset($json['ResponseCode']) &&
            $json['ResponseCode'] === "0"
        ) {
            Payment::create([
                'merchant_request_id' => $json['MerchantRequestID'] ?? null,
                'checkout_request_id' => $json['CheckoutRequestID'] ?? null,
                'amount' => $data['amount'],
                'phone'  => $data['phone'],
            ]);

            return response()->json([
                'success' => true,
                'CheckoutRequestID' => $json['CheckoutRequestID'],
                'MerchantRequestID' => $json['MerchantRequestID'],
                'message' => $json['CustomerMessage'] ?? 'STK sent'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $json['errorMessage'] ?? 'Safaricom rejected request',
            'raw' => $json
        ], 400);
    }

    /* ================= CALLBACK ================= */

    public function stkCallback(Request $request)
    {
        $callback = $request->input('Body.stkCallback');

        Log::info('MPESA CALLBACK', [$callback]);

        if (!$callback) {
            return response()->json(['ResultCode' => 0, 'ResultDesc' => 'OK']);
        }

        $checkoutId = $callback['CheckoutRequestID'];
        $payment = Payment::where('checkout_request_id', $checkoutId)->first();

        if ($payment) {
            $payment->update([
                'result_code' => (string) $callback['ResultCode'],
                'result_desc' => $callback['ResultDesc'],
                'raw_payload' => $request->all(),
            ]);

            if ($callback['ResultCode'] == 0) {
                foreach ($callback['CallbackMetadata']['Item'] as $item) {
                    match ($item['Name']) {
                        'Amount' => $payment->amount = $item['Value'],
                        'MpesaReceiptNumber' => $payment->mpesa_receipt_number = $item['Value'],
                        'PhoneNumber' => $payment->phone = $item['Value'],
                        'TransactionDate' => $payment->transaction_date = $item['Value'],
                        default => null
                    };
                }
                $payment->save();
            }
        }

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Processed']);
    }

    /* ================= STATUS POLL ================= */

    public function checkStatus($checkoutRequestId)
    {
        $payment = Payment::where('checkout_request_id', $checkoutRequestId)->first();

        if (!$payment) {
            return response()->json(['status' => 'pending']);
        }

        return response()->json([
            'status' => match ($payment->result_code) {
                "0" => 'success',
                null => 'pending',
                default => 'failed',
            }
        ]);
    }
}
