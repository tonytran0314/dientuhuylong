@extends('layouts.master')

@section('title', 'Đặt hàng thành công')

@section('content')
    
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                    @if(isset($paymentMessage)) 
                        <h1>{{ $paymentMessage }}</h1>
                    @else
                        <h1>Bạn đã đặt hàng thành công</h1>
                    @endif
                    <p>Cám ơn quý khách đã mua sắm cùng chúng tôi</p>
                    <p>Quý khách vui lòng kiểm tra email để biết thêm chi tiết</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
                    <a href="{{ route('orders.index') }}" class="btn btn-primary">Theo dõi đơn hàng</a>

                </div>
            </div>
        </div>
@stop