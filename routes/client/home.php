<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// =================================== HOME ROUTE =================================== //
Route::get('/', [HomeController::class, 'home'])->name('home');