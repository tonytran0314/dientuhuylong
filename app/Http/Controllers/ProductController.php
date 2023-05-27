<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SearchRequest;

use Illuminate\Support\Facades\Redirect;

use App\Models\Product;
use App\Models\Comment;
use App\Models\Category;

class ProductController extends Controller
{

    // ========================================= GET ========================================= //

    public function detail($slug) {

        $detail = Product::slug($slug)->firstOrFail();
        $category_id = $detail->category->id;
        $product_id = $detail->id;
        $relatedProducts = Product::where([
                                            ['category_id', $category_id],
                                            ['id', '<>', $product_id]
                                        ])->get();
        $relatedProductsCount = Product::where([
                                            ['category_id', $category_id],
                                            ['id', '<>', $product_id]
                                        ])->count();

        $comments = Comment::where('product_id', $product_id)->orderBy('id', 'desc')->paginate(10);

        return view('dynamic.product.detail', [
            'detail' => $detail,
            'relatedProducts' => $relatedProducts,
            'relatedProductsCount' => $relatedProductsCount,
            'comments' => $comments
        ]);
    }

    public function byCate($cate_slug) {
        $category = Category::slug($cate_slug)->firstOrFail();
        $id = $category->id;
        
        return view('dynamic.product.byCate', [
            'productsByCategory' => Product::where('category_id', $id)->paginate(9),
            'category' => $category,
            'prodCount' => Product::where('category_id', $id)->count()
        ]);
    }

    public function searchResult($keyword) {
        $search_result = Product::where("name", "like", "%$keyword%")->paginate(6);
        
        $result_count = $search_result->total();

        return view('dynamic.product.search', [
            'search_results' => $search_result,
            'result_count' => $result_count
        ]);
    }

    // ========================================= POST ========================================= //

    public function search(SearchRequest $request) {
        $request->validated($request->all());

        return Redirect::route('product.searchResult', $request->search_keyword);
    }
}
