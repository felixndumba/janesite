<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('main');
});


Route::get('/services', function () {
    return view('partials.services');
})->name('services');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

