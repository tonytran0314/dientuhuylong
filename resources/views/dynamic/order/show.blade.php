@extends('layouts.master')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="section">
    <div class="container">
        <div class="row">

            {{-- PAGE TITLE --}}
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Chi tiết đơn hàng</h3>
                </div>
            </div>

            {{-- BODY  --}}
            <div id="product-tab">
                <h3>Thông tin đơn</h3>
                <table class="table">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <td>{{ $detail->id }}</td>
                    </tr>
                    <tr>
                        <th>Tổng cộng</th>
                        <td>{{ number_format($detail->Amount) }}</td>
                    </tr>
                    <tr>
                        <th>Khách hàng</th>
                        <td>{{ $detail->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Thời điểm đặt hàng</th>
                        <td>{{ $detail->order_time }}</td>
                    </tr>
                    <tr>
                        <th>Phương thức thanh toán</th>
                        <td>{{ $detail->payment_method->method }}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái thanh toán</th>
                        <td class="alert-{{ $paymentColor }}">{{ $detail->payment_status->status }}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái đơn hàng</th>
                        <td class="alert-{{ $orderColor }}">{{ $detail->status->status_name }}</td>
                    </tr>
                    <tr>
                        <th>Địa chỉ giao hàng</th>
                        <td>alkdjalskfjaskfjlks</td>
                    </tr>
                </table>

                <hr>

                <h3>Sản phẩm</h3>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Tổng cộng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ number_format($item->price) }}</td>
                                <td>{{ $item->pivot->quantity }}</td>
                                <td>{{ number_format($item->price * $item->pivot->quantity) }}</td>
                            </tr>
                        @endforeach
                        
                        <tr>
                            <th colspan="3">Tổng cộng</th>
                            <td><strong>{{ number_format($detail->Amount) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop