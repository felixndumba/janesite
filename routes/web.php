<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('main');
});


Route::get('/services', function () {
    return view('partials.services');
})->name('services');

Route::get('/explore-more', function () {
    return view('contact');
})->name('explore');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/Master-class', function () {
    return view('master-class');
})->name('master');


Route::get('/service-individual-free',
 function () {
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

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

