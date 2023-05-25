@extends('admin.layouts.template')

@section('title', 'Chi tiết đơn hàng')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">
            Chi tiết đơn hàng
        </h1>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">

            @if (session('successMessage'))
                <div class="alert alert-success">
                    {{ session('successMessage') }}
                </div>
            @endif

            <div>
                @if ($detail->status_id == 4)
                    <form action="{{ route('admin.order.confirm') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $detail->id }}">
                        <button type="submit" class="btn btn-primary mb-4">Xác nhận đơn hàng</button>
                    </form>
                @endif

                @if ($detail->status_id == 14)
                    <form action="{{ route('admin.order.complete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $detail->id }}">
                        <button type="submit" class="btn btn-success mb-4">Hoàn thành đơn hàng</button>
                    </form>
                @endif

                @if ($detail->status_id != 24 && $detail->status_id != 34)

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger mb-4" data-toggle="modal" data-target="#exampleModal">
                        Hủy đơn hàng
                    </button>

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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <form action="{{ route('admin.order.destroy') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $detail->id }}">
                                    <button type="submit" class="btn btn-danger">Xác nhận hủy đơn hàng</button>
                                </form>
                            </div>
                            </div>
                    </div>
                    </div>

                @endif
            </div>

            <div class="table-responsive">
                <h4>Thông tin đơn</h4>
                <table class="table table-bordered mb-4" id="dataTable" width="100%" cellspacing="0">
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
                        <td>fjsdfhksjdhk</td>
                    </tr>
                </table>

                <h4>Sản phẩm</h4>
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
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