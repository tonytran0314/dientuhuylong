<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController as ClientProductController;

Route::prefix('product')->group(function () {
    Route::controller(ClientProductController::class)->group(function () {
        Route::get('/detail/{slug}', 'detail')->name('product.detail');
        Route::get('/byCate/{cate_slug}', 'byCate')->name('product.byCate');
        Route::get('/search_result/{keyword}', 'searchResult')->name('product.searchResult');
        Route::get('/checkout', 'checkout')->name('product.checkout')->middleware(['auth', 'role:user']);

        Route::post('/search', 'search')->name('product.search');
    });
});

