<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Models\Order;
use App\Models\User;
use App\Models\ProductUser;

class CODController extends Controller
{
    public function store(){
        Order::insert([
            'id' => Session::get('uuid'),
            'Amount' => Session::get('Amount'),
            'user_id' => Auth::user()->id,
            'status_id' => 4,
            'order_time' => date("Y-m-d H:i:s"),
            'payment_method_id' => 4,
            'payment_status_id' => 0,
        ]);

        ProductUser::where('user_id', Auth::user()->id)->delete();

        return Redirect::route('checkout.result');
    }
}
