@extends('layouts.master')

@section('title', 'Danh sách đơn hàng')

@section('content')
<div class="section">
    <div class="container">
        <div class="row">

            {{-- PAGE TITLE --}}
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Đơn hàng</h3>
                </div>
            </div>

            {{-- BODY  --}}
            <div id="product-tab">
                <!-- product tab nav -->
                <ul class="tab-nav">
                    <li class="active"><a data-toggle="tab" href="#tab1">Đơn đang xử lý</a></li>
                    <li><a data-toggle="tab" href="#tab2">Đơn đã hoàn thành</a></li>
                    <li><a data-toggle="tab" href="#tab3">Đơn đã hủy</a></li>
                </ul>
                <!-- /product tab nav -->

                <!-- product tab content -->
                <div class="tab-content">
                    <!-- tab1  -->
                    <div id="tab1" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-md-12">
                                @if (count($incompletedOrders))
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Mã đơn hàng</th>
                                                <th>Tổng cộng</th>
                                                <th>Ngày đặt hàng</th>
                                                <th>Phương thức thanh toán</th>
                                                <th>Trạng thái thanh toán</th>
                                                <th>Trạng thái đơn hàng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($incompletedOrders as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ number_format($order->Amount) }}</td>
                                                    <td>{{ $order->order_time }}</td>
                                                    <td>{{ $order->payment_method->method }}</td>
                                                    <td>{{ $order->payment_status->status }}</td>
                                                    <td>{{ $order->status->status_name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>Hiện chưa có đơn nào</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /tab1  -->

                    <!-- tab2  -->
                    <div id="tab2" class="tab-pane fade in">
                        <div class="row">
                            <div class="col-md-12">
                                @if (count($completedOrders))
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Mã đơn hàng</th>
                                                <th>Tổng cộng</th>
                                                <th>Ngày đặt hàng</th>
                                                <th>Phương thức thanh toán</th>
                                                <th>Trạng thái thanh toán</th>
                                                <th>Trạng thái đơn hàng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($completedOrders as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ number_format($order->Amount) }}</td>
                                                    <td>{{ $order->order_time }}</td>
                                                    <td>{{ $order->payment_method->method }}</td>
                                                    <td>{{ $order->payment_status->status }}</td>
                                                    <td>{{ $order->status->status_name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>Hiện chưa có đơn nào</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /tab2  -->

                    <!-- tab3  -->
                    <div id="tab3" class="tab-pane fade in">
                        <div class="row">
                            <div class="col-md-12">
                                @if (count($cancelledOrders))
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Mã đơn hàng</th>
                                                <th>Tổng cộng</th>
                                                <th>Ngày đặt hàng</th>
                                                <th>Phương thức thanh toán</th>
                                                <th>Trạng thái đơn hàng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cancelledOrders as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ number_format($order->Amount) }}</td>
                                                    <td>{{ $order->order_time }}</td>
                                                    <td>{{ $order->payment_method->method }}</td>
                                                    <td>{{ $order->status->status_name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>Hiện chưa có đơn nào</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /tab3  -->
                </div>
            </div>
        </div>
    </div>
</div>
@stop