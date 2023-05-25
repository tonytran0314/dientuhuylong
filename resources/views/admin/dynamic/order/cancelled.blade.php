@extends('admin.layouts.template')

@section('title', 'Đơn hàng đã hủy')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    @if(count($cancelledOrders))

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">
                Đơn hàng đã hủy
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

                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tổng cộng</th>
                                <th>Khách hàng</th>
                                <th>Thời điểm đặt hàng</th>
                                <th>Phương thức thanh toán</th>
                                <th>Trạng thái đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cancelledOrders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->Amount }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->order_time }}</td>
                                    <td>{{ $order->payment_method->method }}</td>
                                    <td class="alert-danger">{{ $order->status->status_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @else

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">
                Hiện chưa có đơn hàng nào đã hủy
            </h1>
        </div>

    @endif

</div>
@stop