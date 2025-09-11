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
        return env('MPESA_ENV') === 'sandbox'
            ? 'https://sandbox.safaricom.co.ke'
            : 'https://api.safaricom.co.ke';
    }

    private function accessToken(): string
    {
        $key = env('MPESA_CONSUMER_KEY');
        $secret = env('MPESA_CONSUMER_SECRET');

        $res = Http::withBasicAuth($key, $secret)
            ->get($this->baseUrl().'/oauth/v1/generate?grant_type=client_credentials');

        if (!$res->ok()) {
            Log::error('M-PESA Token Error', $res->json());
            abort(500, 'Failed to get access token');
        }

        return $res->json()['access_token'];
    }

    private function password(string $shortcode, string $passkey, string $timestamp): string
    {
        return base64_encode($shortcode.$passkey.$timestamp);
    }

    /** STEP A: Initiate STK Push */
    public function stkPush(Request $request)
    {
        $data = $request->validate([
            'amount' => ['required','numeric','min:1'],
            'phone'  => ['required','regex:/^2547\d{8}$/'],
            'account_reference' => ['nullable','string','max:20'],
            'description'       => ['nullable','string','max:60'],
        ]);

        $shortcode = env('MPESA_SHORTCODE');
        $timestamp = now()->format('YmdHis');
        $password  = $this->password($shortcode, env('MPESA_PASSKEY'), $timestamp);

        $payload = [
            "BusinessShortCode" => $shortcode,
            "Password"          => $password,
            "Timestamp"         => $timestamp,
            "TransactionType"   => env('MPESA_ENV') === 'sandbox' 
                                    ? "CustomerPayBillOnline" 
                                    : "CustomerBuyGoodsOnline",
            "Amount"            => (int)$data['amount'],
            "PartyA"            => $data['phone'],
            "PartyB"            => $shortcode,
            "PhoneNumber"       => $data['phone'],
            "CallBackURL"       => env('MPESA_CALLBACK_URL'),
            "AccountReference"  => $data['account_reference'] ?? 'ORDER',
            "TransactionDesc"   => $data['description'] ?? 'Payment'
        ];

        $res = Http::withToken($this->accessToken())
            ->post($this->baseUrl().'/mpesa/stkpush/v1/processrequest', $payload);

        $json = $res->json();

        Log::info('STK Push Request', $payload);
        Log::info('STK Push Response', $json);

        // Save initial payment
        if (isset($json['CheckoutRequestID'])) {
            Payment::create([
                'merchant_request_id' => $json['MerchantRequestID'] ?? null,
                'checkout_request_id' => $json['CheckoutRequestID'] ?? null,
                'amount' => $data['amount'],
                'phone'  => $data['phone'],
                'result_code' => null,
                'result_desc' => null,
            ]);
        }

        return response()->json($json, $res->status());
    }

    /** STEP B: Handle STK Callback */
    public function stkCallback(Request $request)
    {
        $cb = $request->input('Body.stkCallback');
        Log::info('STK Callback', [$cb]);

        if (!$cb) {
            return response()->json(['ResultCode'=>0, 'ResultDesc'=>'OK']);
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

        return response()->json(['ResultCode'=>0,'ResultDesc'=>'Processed']);
    }

    /** STEP C: Check Status (for frontend polling) */
    public function checkStatus($checkoutRequestID)
    {
        $payment = Payment::where('checkout_request_id', $checkoutRequestID)->first();

        return response()->json([
            'status' => $payment?->result_code === "0" 
                ? 'success' 
                : ($payment?->result_code 
                    ? 'failed' 
                    : 'pending'),
            'payment' => $payment,
        ]);
    }
}
