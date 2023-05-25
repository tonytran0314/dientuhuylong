<?php

namespace App\Http\Controllers\Checkout;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\TpTinh;
use App\Models\ProductOrder;

use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    public function show() {
        $productsInCart = User::find(Auth::user()->id)->products;

        $total_price = 0;
        foreach($productsInCart as $product) {
            $total_price += ($product->price * $product->pivot->quantity);
        }

        return view('dynamic.checkout.show', [
            'productsInCart' => $productsInCart,
            'totalPrice' => $total_price,
            'tinh_tp' => TpTinh::all()
        ]);
    }

    public function storeUserInformation(CheckoutRequest $request) {

        $request->validated($request->all());

        $uuid = Str::uuid();
        $productsInCart = User::find(Auth::user()->id)->products;

        Session::put('uuid', $uuid);

        foreach($productsInCart as $product) {
            ProductOrder::insert([
                'order_id' => $uuid,
                'product_id' => $product->id,
                'quantity' => $product->pivot->quantity
            ]);
        }   

        return view('dynamic.checkout.paymentMethod');
    }

    public function result() {
        return view('dynamic.checkout.result');
    }
}
