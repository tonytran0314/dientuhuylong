<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Order\OrderController;

Route::prefix('orders')->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::controller(OrderController::class)->group(function () {
            Route::get('/', 'index')->name('orders.index');
        });
    });
});

