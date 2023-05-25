<?php

namespace App\Http\Controllers\Checkout;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\TpTinh;
use App\Models\ProductOrder;

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

    public function storeUserInformation() {

        ProductOrder::insert([
            'order_id' => Str::uuid(),
            'product_id' => 2,
            'quantity' => 6

        ]);

        return view('dynamic.checkout.paymentMethod');
    }
}
