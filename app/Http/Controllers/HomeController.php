<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function home() {
        return view('dynamic.home', [
            'lastestProducts' => Product::orderBy('id', 'desc')->take(10)->get(),
            'lastestKeyboards' => Product::where('category_id', '44')->take(5)->get(),
            'lastestMouses' => Product::where('category_id', '54')->take(5)->get()
        ]);
    }
}
