<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Checkout\CheckoutController;

Route::prefix('checkout')->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::controller(CheckoutController::class)->group(function () {
            Route::get('/', 'show')->name('checkout');

            Route::post('/storeUserInformation', 'storeUserInformation')->name('checkout.storeUserInformation');
        });
    });
});

