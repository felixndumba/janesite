<?php

namespace App\Http\Controllers;

use App\Models\MasterclassPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MasterclassController extends Controller
{
    /**
     * Save the customer's email and masterclass information.
     */
    public function saveLinkRequest(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'title' => 'required|string|max:255',
            'youtube_id' => 'required|string|max:100',
        ]);

        try {
            $purchase = MasterclassPurchase::create([
                'email' => $validated['email'],
                'title' => $validated['title'],
                'youtube_id' => $validated['youtube_id'],
            ]);

            Log::info('Masterclass email request saved', [
                'id' => $purchase->id,
                'email' => $purchase->email,
                'title' => $purchase->title,
                'youtube_id' => $purchase->youtube_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your email has been saved. We will send your masterclass link shortly.',
            ]);

        } catch (\Throwable $e) {

            Log::error('Failed to save masterclass email request', [
                'email' => $validated['email'] ?? null,
                'title' => $validated['title'] ?? null,
                'youtube_id' => $validated['youtube_id'] ?? null,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'We could not save your email right now. Please try again.',
            ], 500);
        }
    }
}

