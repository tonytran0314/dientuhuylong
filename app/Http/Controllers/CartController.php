<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductUser;

class CartController extends Controller
{
    // ========================================= GET ========================================= //
    public function show() {
        $user_id = Auth::user()->id;
        $productsInCart = User::find($user_id)->products;
        $productCount = $productsInCart->count();
        
        $total_price = 0;
        foreach($productsInCart as $product) {
            $total_price += ($product->price * $product->pivot->quantity);
        }

        return view('dynamic.product.cart', [
            'productsInCart' => $productsInCart,
            'productCount' => $productCount,
            'totalPrice' => $total_price
        ]);
    }

    // ========================================= POST ========================================= //
    public function add(Request $request) {
        $request->validate([
            'to_cart_product_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'quantity' => 'required|numeric'
        ]);

        $product_id = $request->to_cart_product_id;
        $user_id = $request->user_id;
        $quantity = $request->quantity;

        $existed_record = ProductUser::where([
                                        ['user_id', $user_id],
                                        ['product_id', $product_id]
                                    ])->first();

        if ($existed_record) {
            $quantity += $existed_record->quantity;
            $existed_record->user_id = $user_id;
            $existed_record->product_id = $product_id;
            $existed_record->quantity = $quantity;
            $existed_record->save();
        } else {
            $cart = new ProductUser;
            $cart->user_id = $user_id;
            $cart->product_id = $product_id;
            $cart->quantity = $quantity;
            $cart->save();
        }

        return redirect(route('home'));
    }

    public function edit(Request $request) {
        $request->validate([
            'product_user_id' => 'required|numeric',
            'new_quantity' => 'required|numeric'
        ]);

        $id = $request->product_user_id;
        $new_quantity = $request->new_quantity;

        $cart_item = ProductUser::find($id);

        $cart_item->quantity = $new_quantity;
        $cart_item->save();
        
        return redirect(route('product.cart.show'));
    }

    public function remove(Request $request) {
        $request->validate([
            'remove_product_user_id' => 'required|numeric'
        ]);
        $id = $request->remove_product_user_id;

        ProductUser::where('id', $id)->forceDelete();

        return redirect(route('product.cart.show'));
    }
}
