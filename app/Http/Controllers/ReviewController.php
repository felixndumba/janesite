<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->get();

        return view('reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'organisation' => 'required',
            'rating' => 'required',
            'message' => 'required',
        ]);

        $review = Review::create([
            'name' => $request->name,
            'organisation' => $request->organisation,
            'rating' => $request->rating,
            'message' => $request->message,
            'is_verified' => false,
        ]);

        return response()->json([
            'success' => true,
            'review' => $review,
        ]);
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        $review->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}


