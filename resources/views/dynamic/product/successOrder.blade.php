@extends('layouts.master')

@section('title', 'Đặt hàng thành công')

@section('content')
    
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                    
                    <h1>Bạn đã đặt hàng thành công</h1>
                    <p>Cám ơn quý khách đã mua sắm cùng chúng tôi</p>
                    <a href="{{ route('home') }}" class="btn btn-success">Tiếp tục mua sắm</a>

                </div>
            </div>
        </div>
@stop