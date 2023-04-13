<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        $comments = Comment::where('product_id', $product_id)->orderBy('id', 'desc')->paginate(10);

        return view('dynamic.product.detail', [
            'detail' => $detail,
            'relatedProducts' => $relatedProducts,
            'comments' => $comments
        ]);

    }

    public function byCate($cate_slug) {
        $category = Category::slug($cate_slug)->firstOrFail();
        $id = $category->id;
        
        $productsByCategory = Product::where('category_id', $id)->paginate(9);
        
        return view('dynamic.product.byCate', [
            'productsByCategory' => $productsByCategory,
            'category' => $category
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

    public function checkout() {
        $user_id = Auth::user()->id;
        $productsInCart = User::find($user_id)->products;

        $total_price = 0;
        foreach($productsInCart as $product) {
            $total_price += ($product->price * $product->pivot->quantity);
        }

        return view('dynamic.product.checkout', [
            'productsInCart' => $productsInCart,
            'totalPrice' => $total_price
        ]);
    }

    // ========================================= POST ========================================= //

    public function search(Request $request) {
        $request->validate([
            'search_keyword' => 'required|regex:/^[a-zA-Z0-9 ]+$/'
        ]);

        $keyword = $request->search_keyword;

        return redirect(route('product.searchResult', $keyword));
    }


}
