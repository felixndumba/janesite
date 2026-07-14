<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
Route::get('/reviews', [ReviewController::class, 'index']);

Route::post('/reviews', [ReviewController::class, 'store']);



Route::get('/', function () {
    $reviews = \App\Models\Review::latest()->get();
    return view('main', compact('reviews'));
});

Route::post('/', function(Request $request) {
    $data = $request->all();
    return response()->json([
        'message' => 'POST received at homepage',
        'data' => $data
    ]);
});


Route::get('/services', function () {
    return view('services'); // Choose the correct view
})->name('services');


Route::get('/explore-more', function () {
    return view('contact');
})->name('explore');


Route::get('/Master-class', function () {
    return view('master-class');
})->name('master');

// Optional SEO: keep only one canonical URL for master class.
// (We rely on per-page meta in the view.)


Route::get('/service-individual-free', function () {
    return view('partials.individual-free');
})->name('individual-free');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');



Route::get('/products', function () {
    return view('products-1');
})->name('products');


Route::get('/meet-jane', function () {
    return view('meetjane');
})->name('meet-jane');

Route::get('/sitemap.xml', function () {
    return response()->view('sitemap')->header('Content-Type', 'text/xml');
});

Route::post('/contact/send', [ContactController::class, 'send'])
    ->name('contact.send');

use App\Http\Controllers\ProductInquiryController;

Route::post('/product/inquiry', [ProductInquiryController::class, 'send'])
    ->name('product.inquiry');
