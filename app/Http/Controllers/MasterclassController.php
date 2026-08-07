<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MasterclassController extends Controller
{
    /**
     * Send the purchased masterclass video link to the customer's email
     * using the ZeptoMail HTTP API (same pattern as ContactController).
     */
    public function sendLink(Request $request)
    {
        $data = $request->validate([
            'email'   => 'required|email',
            'title'   => 'required|string|max:255',
            'youtube_id' => 'required|string|max:100',
        ]);

        $videoUrl = 'https://www.youtube.com/watch?v=' . $data['youtube_id'];

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
                        'address' => $data['email'],
                        'name'    => $data['email'],
                    ]
                ]
            ],
            'subject' => 'Your Masterclass Video Link: ' . $data['title'],
            'htmlbody' => "
                <div style=\"font-family:Arial,Helvetica,sans-serif;max-width:600px;margin:auto;padding:24px;\">
                    <h2 style=\"color:#8C3E32;\">Your Masterclass is ready!</h2>
                    <p>Thank you for your purchase. Here is the link to your private video:</p>
                    <p><strong>" . e($data['title']) . "</strong></p>
                    <p style=\"margin:24px 0;\">
                        <a href=\"{$videoUrl}\" style=\"background-color:#a04f3f;color:#fff;padding:14px 28px;border-radius:9999px;text-decoration:none;font-weight:bold;display:inline-block;\">
                            Watch Now
                        </a>
                    </p>
                    <p>Or copy this link:<br>
                       <a href=\"{$videoUrl}\">{$videoUrl}</a></p>
                    <hr style=\"margin:32px 0;border:none;border-top:1px solid #eee;\">
                    <p style=\"color:#888;font-size:13px;\">
                        If you have any issues accessing your video, reply to this email and we'll help.
                    </p>
                </div>
            ",
        ]);

        if ($response->failed()) {
            return response()->json([
                'status' => 'error',
                'message' => 'We could not send the email right now. Please try again or contact support.',
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'The video link has been sent to your email.',
        ]);
    }
}
