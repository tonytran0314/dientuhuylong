<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function byCate($slug) {
        return view('dynamic.product.byCate', [
            // 'productsByCategory' => Category::where('')
        ]);
    }
}
