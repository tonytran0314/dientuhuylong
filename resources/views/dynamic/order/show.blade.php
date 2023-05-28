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
                        <td>{{ $detail->address }}</td>
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
                @if ($detail->status_id == 4)  
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#exampleModal">
                        Hủy đơn hàng
                    </button>
                    <!-- / Button trigger modal -->

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">HỦY ĐƠN HÀNG</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Bạn có chắc muốn hủy đơn hàng này không ? 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <form action="{{ route('order.destroy') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $detail->id }}">
                                        <input type="hidden" name="payment_method_id" value="{{ $detail->payment_method_id }}">
                                        <input type="hidden" name="Amount" value="{{ $detail->Amount }}">
                                        <input type="hidden" name="order_time" value="{{ $detail->order_time }}">
                                        <button type="submit" class="btn btn-danger">Xác nhận hủy đơn hàng</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Modal -->
                @endif    
            </div>
        </div>
    </div>
</div>
@stop