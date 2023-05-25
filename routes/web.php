<?php

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

if (App::environment('production')) {
    URL::forceScheme('https');
}

// Auth::routes(['verify' => true]);

// =================================== HOME ROUTE =================================== //
require __DIR__.'/client/home.php';


// =================================== PRODUCT ROUTE =================================== //
require __DIR__.'/client/product.php';


// =================================== CHECKOUT ROUTE =================================== //
require __DIR__.'/client/checkout.php';


// =================================== CHECKOUT ROUTE =================================== //
require __DIR__.'/client/order.php';


// =================================== COMMENT ROUTE =================================== //
require __DIR__.'/client/comment.php';


// =================================== CART ROUTE =================================== //
require __DIR__.'/client/cart.php';


// =================================== CATEGORY ROUTE =================================== //
require __DIR__.'/client/category.php';


// =================================== ADMIN ROUTES =================================== //
require __DIR__.'/admin/admin.php';


// =================================== PROFILES ROUTES =================================== //
require __DIR__.'/client/profile.php';


// =================================== AUTH ROUTES =================================== //
require __DIR__.'/auth.php';

// =================================== AUTH ROUTES =================================== //
require __DIR__.'/client/ajax.php';