<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MasterclassController extends Controller
{
    public function sendLink(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'title' => 'required|string',
            'youtube_id' => 'required|string',
            'price' => 'nullable|numeric',
        ]);

        try {
            $resend = \Resend::client(
                config('services.resend.api_key')
            );

            $youtubeUrl = 'https://www.youtube.com/watch?v=' . $validated['youtube_id'];

            $result = $resend->emails->send([
                'from' => config('services.resend.from_name')
                    . ' <'
                    . config('services.resend.from_address')
                    . '>',

                'to' => [
                    $validated['email'],
                ],

                'subject' => 'Your Masterclass: ' . $validated['title'],

                'html' => '
                    <div style="
                        font-family: Arial, sans-serif;
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 30px;
                        color: #333;
                    ">

                        <h2 style="color:#8C3E32;">
                            Your Masterclass Is Ready 🎉
                        </h2>

                        <p>
                            Thank you for your purchase.
                        </p>

                        <div style="
                            background:#f7f5f2;
                            padding:18px;
                            border-radius:10px;
                            margin:20px 0;
                        ">
                            <strong>
                                ' . e($validated['title']) . '
                            </strong>
                        </div>

                        <p>
                            Click the button below to watch your full masterclass.
                        </p>

                        <p style="margin:30px 0;">
                            <a
                                href="' . e($youtubeUrl) . '"
                                style="
                                    display:inline-block;
                                    background:#8C3E32;
                                    color:#ffffff;
                                    text-decoration:none;
                                    padding:14px 24px;
                                    border-radius:999px;
                                    font-weight:bold;
                                "
                            >
                                Watch Your Masterclass
                            </a>
                        </p>

                        <p style="
                            font-size:13px;
                            color:#777;
                        ">
                            If the button does not work, copy and paste this link:
                        </p>

                        <p style="
                            font-size:13px;
                            word-break:break-all;
                            color:#555;
                        ">
                            ' . e($youtubeUrl) . '
                        </p>

                        <hr style="
                            margin:30px 0;
                            border:0;
                            border-top:1px solid #eee;
                        ">

                        <p style="
                            font-size:12px;
                            color:#999;
                        ">
                            This email was sent because you purchased a masterclass.
                        </p>

                    </div>
                ',
            ]);

            Log::info('Masterclass email sent through Resend', [
                'email' => $validated['email'],
                'title' => $validated['title'],
                'resend_response' => $result,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your masterclass link has been sent to your email.',
            ]);

        } catch (\Throwable $e) {

            Log::error('Masterclass email failed through Resend', [
                'email' => $validated['email'] ?? null,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'We could not send your masterclass link right now. Please try again.',
            ], 500);
        }
    }
}

