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

        try {
            $res = Http::timeout(30)
                ->withBasicAuth($key, $secret)
                ->get($this->baseUrl() . '/oauth/v1/generate?grant_type=client_credentials');

            if (!$res->ok() || !isset($res->json()['access_token'])) {
                Log::error('M-PESA Token Error', $res->json());
                throw new \Exception('Failed to get access token');
            }

            return $res->json()['access_token'];
        } catch (\Exception $e) {
            Log::error('M-PESA Token Exception', ['message' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Generate password for STK Push
     */
    private function password(string $shortcode, string $passkey, string $timestamp): string
    {
        return base64_encode($shortcode . $passkey . $timestamp);
    }

    /**
     * STEP A: Initiate STK Push (asynchronous, safe for Railway)
     */
    public function stkPush(Request $request)
    {
        $data = $request->validate([
            'amount' => ['required','numeric','min:1'],
            'phone'  => ['required','regex:/^2547\d{8}$/'],
            'account_reference' => ['nullable','string','max:20'],
            'description'       => ['nullable','string','max:60'],
        ]);

        $shortcode = env('MPESA_SHORTCODE');
        $till = env('MPESA_TILL_NUMBER');
        $passkey = env('MPESA_PASSKEY');
        $timestamp = now()->format('YmdHis');
        $password  = $this->password($shortcode, $passkey, $timestamp);

        $payload = [
            "BusinessShortCode" => $shortcode,
            "Password"          => $password,
            "Timestamp"         => $timestamp,
            "TransactionType"   => "CustomerBuyGoodsOnline",
            "Amount"            => (int)$data['amount'],
            "PartyA"            => $data['phone'],
            "PartyB"            => $till,
            "PhoneNumber"       => $data['phone'],
            "CallBackURL"       => config('mpesa.callback_url'),
            "AccountReference"  => $data['account_reference'] ?? 'Package',
            "TransactionDesc"   => $data['description'] ?? 'Payment'
        ];

        try {
            // Send STK Push request asynchronously
            $res = Http::timeout(30) // short timeout to avoid Railway killing request
                ->retry(2, 1000)    // retry 2 times with 1s interval
                ->withToken($this->accessToken())
                ->post($this->baseUrl() . '/mpesa/stkpush/v1/processrequest', $payload);

            $json = $res->json();

            Log::info('STK Push Request', $payload);
            Log::info('STK Push Response', $json);

            // Save payment as pending
            Payment::create([
                'merchant_request_id' => $json['MerchantRequestID'] ?? null,
                'checkout_request_id' => $json['CheckoutRequestID'] ?? null,
                'amount' => $data['amount'],
                'phone'  => $data['phone'],
                'result_code' => null,
                'result_desc' => null,
            ]);

            // Return immediately to client
            return response()->json([
                'status' => 'pending',
                'message' => 'STK Push request sent. Wait for callback.',
                'checkout_request_id' => $json['CheckoutRequestID'] ?? null
            ]);

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('STK Push Connection Error', ['message' => $e->getMessage(), 'payload' => $payload]);
            return response()->json([
                'status' => 'error',
                'message' => 'Could not connect to M-Pesa API. Please try again later.'
            ], 503);
        } catch (\Exception $e) {
            Log::error('STK Push General Error', ['message' => $e->getMessage(), 'payload' => $payload]);
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while initiating payment.'
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
        Log::info('Checking payment status for', ['CheckoutRequestID' => $checkoutRequestId]);

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
