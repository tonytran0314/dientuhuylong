<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;
use App\Models\ProductUser;

use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\EditCartRequest;
use App\Http\Requests\Cart\RemoveFromCartRequest;

class CartController extends Controller
{
    // ========================================= GET ========================================= //
    public function show() {
        $user_id = Auth::user()->id;
        $productsInCart = User::find($user_id)->products;
        $productCount = ProductUser::where('user_id', $user_id)->sum('quantity');
        
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
    public function add(AddToCartRequest $request) {
        $request->validated($request->all());

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

        return Redirect::route('home');
    }

    public function edit(EditCartRequest $request) {
        $request->validated($request->all());

        // this way or the way in the admin/CategoryController
        $cart_item = ProductUser::find($request->product_user_id);

        $cart_item->quantity = $request->new_quantity;

        $cart_item->save();
        
        return Redirect::route('product.cart.show');
    }

    public function remove(RemoveFromCartRequest $request) {
        $request->validated($request->all());

        ProductUser::where('id', $request->remove_product_user_id)->forceDelete();

        return Redirect::route('product.cart.show');
    }
}
