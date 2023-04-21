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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            'totalPrice' => $total_price,
            'tinh_tp' => TpTinh::all()
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

    public function checkoutProcess(Request $request) {
        
        // validation
        $request->validate([
            'fullname' => ['required', 'max:255', 'min:5'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'numeric'],
            'tp_tinh' => ['required'],
            'quan_huyen' => ['required'],
            'phuong_xa' => ['required'],
            'number_road' => ['required', 'max:255'],
            'notes' => ['max:255']
        ]);

        // variables assignment
        $fullname = $request->fullname;
        $client_email = $request->email;
        $phone_number = $request->phone_number;

        $tp_tinh = TpTinh::where('matp', $request->tp_tinh)->firstOrFail();
        $quan_huyen = QuanHuyen::where('maqh', $request->quan_huyen)->firstOrFail();
        $phuong_xa = XaPhuongThitran::where('xaid', $request->phuong_xa)->firstOrFail();
        $number_road = $request->number_road;

        $notes = $request->notes;

        // send receipt to client email
        Mail::send(
            'dynamic.product.email', 
            [
                'name' => $fullname,
                'ttp' => $tp_tinh,
                'qh' => $quan_huyen,
                'px' => $phuong_xa,
                'nr' => $number_road
            ], 
            function($email) use ($client_email){
                $email->subject('Điện tử Huy Long - Cám ơn bạn đã mua sắm cùng chúng tôi');
                $email->to($client_email);
            }
        );
    }
}
