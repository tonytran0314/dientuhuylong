<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


use App\Models\Order;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $incompletedOrders = Order::where('user_id', Auth::user()->id)->get();

        $completedOrders = Order::where([
            ['user_id', Auth::user()->id],
            ['status_id', 24]
        ])->get();

        $cancelledOrders = Order::where([
            ['user_id', Auth::user()->id],
            ['status_id', 34]
        ])->get();
        
        return view('dynamic.order.index', [
            'incompletedOrders' => $incompletedOrders,
            'completedOrders' => $completedOrders,
            'cancelledOrders' => $cancelledOrders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
