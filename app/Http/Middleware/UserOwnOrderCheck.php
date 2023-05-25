<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Order;

class UserOwnOrderCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $order_id = $request->route('order_id');
        $id_array = [];
        $orders = Order::where('user_id', Auth::user()->id)->get();
        foreach ($orders as $order ) {
            array_push($id_array, $order->id);
        }
        if(!in_array($order_id, $id_array)) {
            return Redirect::route('orders.index');
        }
        
        return $next($request);
    }
}
