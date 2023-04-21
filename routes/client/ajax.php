<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;

Route::middleware(['auth', 'verified'])->group(function(){
    Route::prefix('ajax')->group(function () {
        Route::controller(AjaxController::class)->group(function () {
            Route::get('/tinhtp/{idTp}', 'showQuanHuyen');
            Route::get('/quanhuyen/{idqh}', 'showPhuongXa');
        });
    });
});