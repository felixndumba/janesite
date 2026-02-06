<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;

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
        $key = env('MPESA_CONSUMER_KEY');
        $secret = env('MPESA_CONSUMER_SECRET');

        if (!$key || !$secret) {
            throw new \Exception('MPESA credentials missing');
        }

        $res = Http::withBasicAuth($key, $secret)
            ->timeout(30)
            ->get($this->baseUrl() . '/oauth/v1/generate?grant_type=client_credentials');

        if (!$res->ok() || !isset($res['access_token'])) {
            Log::error('M-PESA TOKEN FAILED', [
                'status' => $res->status(),
                'body' => $res->body(),
            ]);
            throw new \Exception('Failed to get M-Pesa access token');
        }

        return $res['access_token'];
    }

    private function password(string $shortcode, string $passkey, string $timestamp): string
    {
        return base64_encode($shortcode . $passkey . $timestamp);
    }

    /** STEP A: Initiate STK Push */
    public function stkPush(Request $request)
    {
        try {
            $data = $request->validate([
                'amount' => ['required', 'numeric', 'min:1'],
                'phone'  => ['required', 'regex:/^2547\d{8}$/'],
                'account_reference' => ['nullable', 'string', 'max:20'],
                'description'       => ['nullable', 'string', 'max:60'],
            ]);

            $shortcode = env('MPESA_SHORTCODE');
            $till      = env('MPESA_TILL_NUMBER');
            $passkey   = env('MPESA_PASSKEY');
            $callback  = env('MPESA_CALLBACK_URL');

            if (!$shortcode || !$till || !$passkey || !$callback) {
                throw new \Exception('Missing MPESA env variables');
            }

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
                "CallBackURL"       => $callback,
                "AccountReference"  => $data['account_reference'] ?? 'Payment',
                "TransactionDesc"   => $data['description'] ?? 'Payment',
            ];

            $res = Http::withToken($this->accessToken())
                ->timeout(60)
                ->post($this->baseUrl() . '/mpesa/stkpush/v1/processrequest', $payload);

            $json = $res->json() ?? [
                'error' => true,
                'raw' => $res->body(),
            ];

            Log::info('STK PUSH REQUEST', $payload);
            Log::info('STK PUSH RESPONSE', is_array($json) ? $json : ['raw' => $json]);

            if (isset($json['CheckoutRequestID'])) {
                Payment::create([
                    'merchant_request_id' => $json['MerchantRequestID'] ?? null,
                    'checkout_request_id' => $json['CheckoutRequestID'],
                    'amount' => $data['amount'],
                    'phone'  => $data['phone'],
                ]);
            }

            // ✅ ALWAYS return 200 to frontend
            return response()->json([
                'success' => $res->ok(),
                'data' => $json,
            ]);

        } catch (\Throwable $e) {
            Log::error('STK PUSH ERROR', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment initiation failed',
            ], 200);
        }
    }

    /** STEP B: STK Callback */
    public function stkCallback(Request $request)
    {
        $cb = $request->input('Body.stkCallback');
        Log::info('STK CALLBACK', [$cb]);

        if (!$cb) {
            return response()->json(['ResultCode' => 0, 'ResultDesc' => 'OK']);
        }

        $checkoutRequestId = $cb['CheckoutRequestID'] ?? null;

        $payment = Payment::where('checkout_request_id', $checkoutRequestId)->first();

        if ($payment) {
            $payment->update([
                'result_code' => (string) ($cb['ResultCode'] ?? ''),
                'result_desc' => $cb['ResultDesc'] ?? '',
                'raw_payload' => $request->all(),
            ]);

            if ((string)($cb['ResultCode'] ?? '') === "0") {
                foreach ($cb['CallbackMetadata']['Item'] ?? [] as $item) {
                    match ($item['Name'] ?? '') {
                        'Amount' => $payment->amount = $item['Value'],
                        'MpesaReceiptNumber' => $payment->mpesa_receipt_number = $item['Value'],
                        'PhoneNumber' => $payment->phone = $item['Value'],
                        'TransactionDate' => $payment->transaction_date = $item['Value'],
                        default => null,
                    };
                }
                $payment->save();
            }
        }

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Processed']);
    }

    /** STEP C: Poll payment status */
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
            },
            'payment' => $payment,
        ]);
    }
}
