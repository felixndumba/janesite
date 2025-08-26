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

    /** STEP A: Initiate STK Push (from frontend) */
    public function stkPush(Request $request)
    {
        $data = $request->validate([
            'amount' => ['required','numeric','min:1'],
            'phone'  => ['required','regex:/^2547\d{8}$/'],
            'account_reference' => ['nullable','string','max:20'],
            'description'       => ['nullable','string','max:60'],
        ]);

        $shortcode = env('MPESA_SHORTCODE');
        $password   = env('MPESA_PASSKEY');
    $timestamp = env('MPESA_TIMESTAMP');
   


        $payload = [
            "BusinessShortCode" => $shortcode,
            "Password"          => $password,
            "Timestamp"         => $timestamp,
            // 🔑 Sandbox paybill requires this
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

        Log::info('STK Push Request', $payload);
        Log::info('STK Push Response', $res->json());

        return response()->json($res->json(), $res->status());
    }

    /** STEP B: Handle STK Callback */
    public function stkCallback(Request $request)
    {
        $body = $request->json('Body');
        Log::info('STK Callback', [$body]);

        if (!$body || !isset($body['stkCallback'])) {
            return response()->json(['ResultCode'=>0, 'ResultDesc'=>'OK']);
        }

        $cb = $body['stkCallback'];

        $merchantRequestId = $cb['MerchantRequestID'] ?? null;
        $checkoutRequestId = $cb['CheckoutRequestID'] ?? null;
        $resultCode        = (string)($cb['ResultCode'] ?? '');
        $resultDesc        = $cb['ResultDesc'] ?? '';

        $amount = $receipt = $phone = $transTime = null;

        if (isset($cb['CallbackMetadata']['Item'])) {
            foreach ($cb['CallbackMetadata']['Item'] as $item) {
                $name = $item['Name'] ?? '';
                $val  = $item['Value'] ?? null;
                if ($name === 'Amount') $amount = (string)$val;
                if ($name === 'MpesaReceiptNumber') $receipt = (string)$val;
                if ($name === 'PhoneNumber') $phone = (string)$val;
                if ($name === 'TransactionDate') $transTime = (string)$val;
            }
        }

        Payment::create([
            'merchant_request_id' => $merchantRequestId,
            'checkout_request_id' => $checkoutRequestId,
            'result_code'         => $resultCode,
            'result_desc'         => $resultDesc,
            'amount'              => $amount,
            'mpesa_receipt_number'=> $receipt,
            'phone'               => $phone,
            'transaction_date'    => $transTime,
            'raw_payload'         => $request->all(),
        ]);

        return response()->json(['ResultCode'=>0,'ResultDesc'=>'Processed']);
    }
}
