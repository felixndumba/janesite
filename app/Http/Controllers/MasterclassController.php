<?php

namespace App\Http\Controllers;

use App\Mail\MasterclassLinkMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

            Mail::to($validated['email'])->send(
                new MasterclassLinkMail(
                    $validated['title'],
                    $validated['youtube_id']
                )
            );

            return response()->json([
                'success' => true,
                'message' => 'Masterclass link sent successfully.',
            ]);

        } catch (\Throwable $e) {

            \Log::error('Masterclass email failed', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unable to send the email.',
            ], 500);
        }
    }
}