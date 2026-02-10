<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductInquiryController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'product' => 'required|string|max:255',
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'phone'   => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'Zoho-enczapikey ' . env('ZEPTO_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.zeptomail.com/v1.1/email', [
            'from' => [
                'address' => env('ZEPTO_FROM_EMAIL'),
                'name'    => env('ZEPTO_FROM_NAME'),
            ],
            'to' => [
                [
                    'email_address' => [
                        'address' => env('ZEPTO_FROM_EMAIL'),
                        'name'    => 'Product Inquiry',
                    ]
                ]
            ],
            'reply_to' => [
                [
                    'address' => $data['email'],
                    'name'    => $data['name'],
                ]
            ],
            'subject' => 'New Product Inquiry: ' . $data['product'],
            'htmlbody' => "
                <h3>New Product Inquiry</h3>
                <p><strong>Product:</strong> {$data['product']}</p>
                <p><strong>Name:</strong> {$data['name']}</p>
                <p><strong>Email:</strong> {$data['email']}</p>
                <p><strong>Phone:</strong> {$data['phone']}</p>
                <hr>
                <p><strong>Message:</strong></p>
                <p>{$data['message']}</p>
            ",
        ]);

        if ($response->failed()) {
            return response()->json(['success' => false, 'message' => 'Inquiry failed to send.']);
        }

        return response()->json(['success' => true, 'message' => 'Thank you for your inquiry! We will get back to you soon.']);
    }
}
