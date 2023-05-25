<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Models\Order;
use App\Models\User;

class CODController extends Controller
{
    public function store(){

        $productsInCart = User::find(Auth::user()->id)->products;
        
        $total_price = 0;
        foreach($productsInCart as $product) {
            $total_price += ($product->price * $product->pivot->quantity);
        }

        Order::insert([
            'id' => Session::get('uuid'),
            'Amount' => $total_price,
            'user_id' => Auth::user()->id,
            'status_id' => 4,
            'order_time' => date("Y-m-d H:i:s"),
            'payment_method_id' => 4,
            'payment_status_id' => 4,
        ]);

        // return Redirect::route('');
    }
}
