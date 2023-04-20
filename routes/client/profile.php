<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function(){
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::post('/profile/info', 'update_info')->name('profile.update.info');
        Route::post('/profile/password', 'update_password')->name('profile.update.password');

        // Route::patch('/profile', 'update')->name('profile.update');
        // Route::delete('/profile', 'destroy')->name('profile.destroy');
    });    
});