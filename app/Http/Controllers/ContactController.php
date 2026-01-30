<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
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
                        'name'    => 'Website Contact',
                    ]
                ]
            ],
            'reply_to' => [
                [
                    'address' => $data['email'],
                    'name'    => $data['name'],
                ]
            ],
            'subject' => 'New Contact Message',
            'htmlbody' => "
                <h3>New Contact Message</h3>
                <p><strong>Name:</strong> {$data['name']}</p>
                <p><strong>Email:</strong> {$data['email']}</p>
                <hr>
                <p>{$data['message']}</p>
            ",
        ]);

        if ($response->failed()) {
            return back()->with('error', 'Message failed to send.');
        }

        return back()->with('success', 'Message sent successfully.');
    }
}
