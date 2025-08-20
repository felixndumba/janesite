<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('main');
});
Route::get('/services', function () {
    return view('partials.services');
})->name('services');

