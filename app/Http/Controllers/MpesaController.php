<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;

class MpesaController extends Controller
{
    /**
     * Base URL depending on environment
     */
    private function baseUrl(): string
    {
        return env('MPESA_ENV') === 'production'
            ? 'https://api.safaricom.co.ke'
            : 'https://sandbox.safaricom.co.ke';
    }

    /**
     * Get access token from Safaricom
     */
    private function accessToken(): string
    {
        $key = env('MPESA_CONSUMER_KEY');
        $secret = env('MPESA_CONSUMER_SECRET');

        if (!$key || !$secret) {
            $missing = [];
            if (!$key) $missing[] = 'MPESA_CONSUMER_KEY';
            if (!$secret) $missing[] = 'MPESA_CONSUMER_SECRET';
            $msg = 'Missing required environment variable(s): ' . implode(', ', $missing);
            Log::error($msg);
            throw new \Exception($msg);
        }

        $res = Http::withBasicAuth($key, $secret)
            ->get($this->baseUrl() . '/oauth/v1/generate?grant_type=client_credentials');

        if (!$res->ok() || !isset($res->json()['access_token'])) {
            Log::error('M-PESA Token Error', $res->json());
            throw new \Exception('Unable to generate M-Pesa access token. Please try again later.');
        }

        return $res->json()['access_token'];
    }

    /**
     * Generate password for STK Push
     */
    private function password(string $shortcode, string $passkey, string $timestamp): string
    {
        return base64_encode($shortcode . $passkey . $timestamp);
    }

    /**
     * Normalize phone number to 254XXXXXXXX format
     */
    private function normalizePhone(string $phone): string
    {
        // Remove + if present
        $phone = ltrim($phone, '+');

        // If starts with 07, convert to 2547
        if (preg_match('/^07\d{8}$/', $phone)) {
            $phone = '2547' . substr($phone, 2);
        }
        // If starts with 01, convert to 2541
        elseif (preg_match('/^01\d{8}$/', $phone)) {
            $phone = '2541' . substr($phone, 2);
        }
        // If already 254..., keep as is

        return $phone;
    }

    /**
     * STEP A: Initiate STK Push
     */
    public function stkPush(Request $request)
    {
        // Validate request
        $data = $request->validate([
            'amount' => ['required','numeric','min:1'],
            'phone'  => ['required','regex:/^(\+2547\d{8}|07\d{8}|01\d{8})$/'],
            'account_reference' => ['nullable','string','max:20'],
            'description'       => ['nullable','string','max:60'],
        ]);

        // Read environment variables
        $shortcode = env('MPESA_SHORTCODE');
        $till      = env('MPESA_TILL_NUMBER');
        $passkey   = env('MPESA_PASSKEY');
        $callback  = env('MPESA_CALLBACK_URL');

        $missing = [];
        if (!$shortcode) $missing[] = 'MPESA_SHORTCODE';
        if (!$till) $missing[] = 'MPESA_TILL_NUMBER';
        if (!$passkey) $missing[] = 'MPESA_PASSKEY';
        if (!$callback) $missing[] = 'MPESA_CALLBACK_URL';

        if (!empty($missing)) {
            $msg = 'Payment cannot proceed. Missing configuration: ' . implode(', ', $missing);
            Log::error($msg);
            return response()->json([
                'status' => 'error',
                'message' => $msg
            ], 500);
        }

        $timestamp = now()->format('YmdHis');
        $password  = $this->password($shortcode, $passkey, $timestamp);

        // Normalize phone number
        $normalizedPhone = $this->normalizePhone($data['phone']);

        // Ensure normalized phone starts with 2547 for M-Pesa compatibility
        if (!preg_match('/^2547\d{8}$/', $normalizedPhone)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid phone number. Only mobile numbers starting with 07 or +2547 are supported.'
            ], 400);
        }

        $payload = [
            "BusinessShortCode" => $shortcode,
            "Password"          => $password,
            "Timestamp"         => $timestamp,
            "TransactionType"   => "CustomerBuyGoodsOnline",
            "Amount"            => (int)$data['amount'],
            "PartyA"            => $normalizedPhone,
            "PartyB"            => $till,
            "PhoneNumber"       => $normalizedPhone,
            "CallBackURL"       => $callback,
            "AccountReference"  => $data['account_reference'] ?? 'Package',
            "TransactionDesc"   => $data['description'] ?? 'Payment'
        ];

        try {
            $res = Http::timeout(30)
                ->withToken($this->accessToken())
                ->post($this->baseUrl() . '/mpesa/stkpush/v1/processrequest', $payload);

            $json = $res->json();

            Log::info('STK Push Request', $payload);
            Log::info('STK Push Response', $json);

            if (isset($json['ResponseCode']) && $json['ResponseCode'] !== '0') {
                return response()->json([
                    'status' => 'error',
                    'message' => $json['errorMessage'] ?? 'Failed to initiate payment. Please try again.'
                ], 400);
            }

            Payment::create([
                'merchant_request_id' => $json['MerchantRequestID'] ?? null,
                'checkout_request_id' => $json['CheckoutRequestID'] ?? null,
                'amount' => $data['amount'],
                'phone'  => $normalizedPhone,
                'result_code' => null,
                'result_desc' => null,
            ]);

            return response()->json([
                'status' => 'pending',
                'message' => 'Payment request sent! Check your M-Pesa app and enter your PIN.',
                'checkout_request_id' => $json['CheckoutRequestID'] ?? null
            ]);

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('STK Push Connection Error', [
                'message' => $e->getMessage(),
                'payload' => $payload
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Could not connect to M-Pesa. Check your internet and try again.'
            ], 503);

        } catch (\Exception $e) {
            Log::error('STK Push General Error', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
                'payload' => $payload
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while initiating payment. Please try again.',
            ], 500);
        }
    }

    /**
     * STEP B: STK Callback from Safaricom
     */
    public function stkCallback(Request $request)
    {
        $cb = $request->input('Body.stkCallback');
        Log::info('STK Callback', [$cb]);

        if (!$cb) {
            return response()->json(['ResultCode' => 0, 'ResultDesc' => 'OK']);
        }

        $checkoutRequestId = $cb['CheckoutRequestID'] ?? null;
        $payment = Payment::where('checkout_request_id', $checkoutRequestId)->first();

        if ($payment) {
            $payment->update([
                'result_code'  => (string)($cb['ResultCode'] ?? ''),
                'result_desc'  => $cb['ResultDesc'] ?? '',
                'raw_payload'  => $request->all(),
            ]);

            if ($cb['ResultCode'] === 0 && isset($cb['CallbackMetadata']['Item'])) {
                foreach ($cb['CallbackMetadata']['Item'] as $item) {
                    $name = $item['Name'] ?? '';
                    $val  = $item['Value'] ?? null;
                    if ($name === 'Amount') $payment->amount = (string)$val;
                    if ($name === 'MpesaReceiptNumber') $payment->mpesa_receipt_number = (string)$val;
                    if ($name === 'PhoneNumber') $payment->phone = (string)$val;
                    if ($name === 'TransactionDate') $payment->transaction_date = (string)$val;
                }
                $payment->save();
            }
        } else {
            Log::warning('Callback for unknown CheckoutRequestID', [$checkoutRequestId]);
        }

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Processed']);
    }

    /**
     * STEP C: Check payment status
     */
    public function checkStatus($checkoutRequestId)
    {
        $payment = Payment::where('checkout_request_id', $checkoutRequestId)->first();

        if (!$payment) {
            return response()->json(['status' => 'pending', 'payment' => null]);
        }

        $status = match ($payment->result_code) {
            "0" => 'success',
            null => 'pending',
            default => 'failed',
        };

        return response()->json([
            'status' => $status,
            'payment' => [
                'checkout_request_id' => $payment->checkout_request_id,
                'amount' => $payment->amount,
                'phone' => $payment->phone,
                'mpesa_receipt_number' => $payment->mpesa_receipt_number,
                'transaction_date' => $payment->transaction_date,
                'result_code' => $payment->result_code,
                'result_desc' => $payment->result_desc,
            ],
        ]);
    }
}
