<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Models\Order;
use App\Models\TpTinh;
use App\Models\QuanHuyen;
use App\Models\ProductUser;
use App\Models\XaPhuongThitran;

class CODController extends Controller
{
    public function store(){

        $nr = Session::get('nr');
        $tp_tinh = TpTinh::where('matp', Session::get('ttp'))->firstOrFail()->name;
        $quan_huyen = QuanHuyen::where('maqh', Session::get('qh'))->firstOrFail()->name;
        $phuong_xa = XaPhuongThitran::where('xaid', Session::get('px'))->firstOrFail()->name;

        $address = "{$nr}, {$phuong_xa}, {$quan_huyen}, {$tp_tinh}";
        
        Order::insert([
            'id' => Session::get('uuid'),
            'Amount' => Session::get('Amount'),
            'user_id' => Auth::user()->id,
            'status_id' => 4,
            'order_time' => date("Y-m-d H:i:s"),
            'payment_method_id' => 4,
            'payment_status_id' => 0,
            'phone_number' => Session::get('phone_number'),
            'address' => $address,
            'notes' => Session::get('notes'),
            'email' => Session::get('email'),
        ]);

        ProductUser::where('user_id', Auth::user()->id)->delete();

        return Redirect::route('checkout.result');
    }
}
