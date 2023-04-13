<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::middleware(['auth', 'verified'])->group(function(){
    Route::prefix('cart')->group(function () {
        Route::controller(CartController::class)->group(function () {
            Route::get('/', 'show')->name('product.cart.show');

            Route::post('/add', 'add')->name('product.cart.add');
            Route::post('/remove', 'remove')->name('product.cart.remove');
            Route::post('/edit', 'edit')->name('product.cart.edit');
        });
    });
});