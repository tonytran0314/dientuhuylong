<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::middleware(['auth', 'role:admin', 'verified'])->group(function(){
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('/products')->group(function () {
            Route::controller(ProductController::class)->group(function () {
                Route::get('/', 'show')->name('product.admin.show');
                Route::get('/detail/{slug}', 'detail')->name('product.admin.detail');
                Route::get('/edit/{slug}', 'edit')->name('product.admin.edit');
                Route::get('/hidden', 'hidden')->name('product.admin.hidden');
                Route::get('/byCategory/{category_id}', 'byCategory')->name('product.admin.byCategory');
                Route::get('/add', 'add')->name('product.admin.add');

                Route::post('/editProcess', 'editProcess')->name('product.admin.editProcess');
                Route::post('/hideProcess', 'hideProcess')->name('product.admin.hideProcess');
                Route::post('/restore', 'restore')->name('product.admin.restore');
                Route::post('/deleteProcess', 'deleteProcess')->name('product.admin.deleteProcess');
                Route::post('/addProcess', 'addProcess')->name('product.admin.addProcess');
            });
        });
        
        Route::prefix('/categories')->group(function () {
            Route::controller(CategoryController::class)->group(function () {
                Route::get('/', 'show')->name('category.admin.show');
                Route::get('/edit/{slug}', 'edit')->name('category.admin.edit');
                Route::get('/add', 'add')->name('category.admin.add');

                Route::post('/editProcess', 'editProcess')->name('category.admin.editProcess');
                Route::post('/deleteProcess', 'deleteProcess')->name('category.admin.deleteProcess');
                Route::post('/addProcess', 'addProcess')->name('category.admin.addProcess');
            });
        });
    });
});