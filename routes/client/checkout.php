<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Payment\CODController;
use App\Http\Controllers\Payment\VNPayController;

Route::prefix('checkout')->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::controller(CheckoutController::class)->group(function () {
            Route::get('/', 'show')->name('checkout');
            Route::get('/result', 'result')->name('checkout.result');

            Route::post('/payment_method', 'storeUserInformation')->name('checkout.storeUserInformation');
        });
        Route::controller(CODController::class)->group(function () {
            Route::post('/cod', 'store')->name('payment.cod');
        });
        Route::controller(VNPayController::class)->group(function () {
            Route::post('/vnpay', 'store')->name('payment.vnpay');
        });
    });
});

