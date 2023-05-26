<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Models\Order;

class OrderController extends Controller
{
    public function incompletedOrders() {

        $orders = Order::where([
            ['status_id', '<>', 24],
            ['status_id', '<>', 34]
        ])->orderBy('order_time', 'desc')->get();

        return view('admin.dynamic.order.incompleted', [
            'orders' => $orders
        ]);
    }

    public function completedOrders() {
        $completedOrders = Order::where('status_id', 24)->orderBy('order_time', 'desc')->get();

        return view('admin.dynamic.order.completed', [
            'completedOrders' => $completedOrders
        ]);

    }

    public function cancelledOrders() {
        $cancelledOrders = Order::where('status_id', 34)->orderBy('order_time', 'desc')->get();

        return view('admin.dynamic.order.cancelled', [
            'cancelledOrders' => $cancelledOrders
        ]);
    }

    public function confirm(Request $request) {
        Order::where('id', $request->order_id)->update(['status_id' => 14]);

        return Redirect::back();
    }

    public function complete(Request $request) {

        Order::where('id', $request->order_id)->update([
            'status_id' => 24,
            'payment_status_id' => 14
        ]);

        return Redirect::back();
    }

    public function show($order_id) {
        $orderDetail = Order::find($order_id);
        $items = $orderDetail->items_in_order;

        $paymentColor = ($orderDetail->payment_status_id == 14) ? 'success' : 'warning';
        $orderColor = ($orderDetail->status_id == 14 || $orderDetail->status_id == 24) ? 'success' : 'warning';
        
        return view('admin.dynamic.order.show', [
            'detail' => $orderDetail,
            'items' => $items,
            'paymentColor' => $paymentColor,
            'orderColor' => $orderColor
        ]);
    }

    public function destroy(Request $request)
    {
        Order::where('id', $request->order_id)->update(['status_id' => 34]);
        
        // refund if paid by vnpay

        return Redirect::route('admin.orders.incompleted');
    }
}
