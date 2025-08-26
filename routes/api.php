<?php
use App\Http\Controllers\MpesaController;
use Illuminate\Support\Facades\Route;

Route::post('/mpesa/stk/initiate', [MpesaController::class, 'stkPush'])->name('mpesa.initiate');
Route::post('/stk/callback', [MpesaController::class, 'stkCallback'])->name('mpesa.stk.callback');

// (Optional C2B) if you’ll register till URLs later
Route::post('/c2b/validation', [MpesaController::class, 'c2bValidation'])->name('mpesa.c2b.validation');
Route::post('/c2b/confirmation', [MpesaController::class, 'c2bConfirmation'])->name('mpesa.c2b.confirmation');
Route::get('/test', function() {
    return response()->json(['status' => 'ok']);
});
