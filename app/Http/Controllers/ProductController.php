<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Comment;
use App\Models\Category;
use App\Models\User;
use App\Models\TpTinh;
use App\Models\QuanHuyen;
use App\Models\XaPhuongThitran;
use App\Models\ProductUser;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\CheckoutRequest;

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

    public function checkout() {
        $productsInCart = User::find(Auth::user()->id)->products;

        $total_price = 0;
        foreach($productsInCart as $product) {
            $total_price += ($product->price * $product->pivot->quantity);
        }

        return view('dynamic.checkout.checkout', [
            'productsInCart' => $productsInCart,
            'totalPrice' => $total_price,
            'tinh_tp' => TpTinh::all()
        ]);
    }

    public function success_order($client_email) {
        return view('dynamic.product.successOrder', ['client_email' => $client_email]);
    }


    // ========================================= POST ========================================= //

    public function search(SearchRequest $request) {
        $request->validated($request->all());

        return Redirect::route('product.searchResult', $request->search_keyword);
    }

    public function checkoutProcess(CheckoutRequest $request) {
        
        $request->validated($request->all());

        // variables assignment
        $fullname = $request->fullname;
        $client_email = $request->email;
        $phone_number = $request->phone_number;

        $tp_tinh = TpTinh::where('matp', $request->tp_tinh)->firstOrFail();
        $quan_huyen = QuanHuyen::where('maqh', $request->quan_huyen)->firstOrFail();
        $phuong_xa = XaPhuongThitran::where('xaid', $request->phuong_xa)->firstOrFail();
        $number_road = $request->number_road;

        $notes = $request->notes;

        // items in cart 
        $productsInCart = User::find(Auth::user()->id)->products;

        $total_price = 0;
        foreach($productsInCart as $product) {
            $total_price += ($product->price * $product->pivot->quantity);
        }

        // send receipt to client email
        Mail::send(
            'dynamic.product.email', 
            [
                'name' => $fullname,
                'ttp' => $tp_tinh,
                'qh' => $quan_huyen,
                'px' => $phuong_xa,
                'nr' => $number_road,
                'total' => $total_price,
                'prodsInCart' => $productsInCart
            ], 
            function($email) use ($client_email){
                $email->subject('Điện tử Huy Long - Cám ơn bạn đã mua sắm cùng chúng tôi');
                $email->to($client_email);
            }
        );
        
        // ProductUser::where('user_id', Auth::user()->id)->delete();

        return Redirect::route('product.success_order', $client_email);

    }
}
