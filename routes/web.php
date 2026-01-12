<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home page (GET)
Route::get('/', function () {
    return view('main');
});

// Optional: handle POST on homepage if needed
Route::post('/', function(Request $request) {
    // Example: receive form data from homepage
    $data = $request->all();
    return response()->json([
        'message' => 'POST received at homepage',
        'data' => $data
    ]);
});

// Services page
Route::get('/services', function () {
    return view('services'); // Choose the correct view
})->name('services');

// Explore more / contact page
Route::get('/explore-more', function () {
    return view('contact');
})->name('explore');

// Master Class page
Route::get('/Master-class', function () {
    return view('master-class');
})->name('master');

// Individual free service
Route::get('/service-individual-free', function () {
    return view('partials.individual-free');
})->name('individual-free');

// Contact page (GET)
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Handle POST from contact form
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// Products page
Route::get('/products', function () {
    return view('products-1');
})->name('products');

// Meet Jane page
Route::get('/meet-jane', function () {
    return view('meetjane');
})->name('meet-jane');
