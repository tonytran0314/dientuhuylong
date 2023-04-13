<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function home() {
        return view('dynamic.home', [
            'allProducts' => Product::all()
        ]);
    }
}
