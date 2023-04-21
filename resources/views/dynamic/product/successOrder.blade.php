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
                    <p>Một email xác nhận sẽ được gởi đến địa chỉ email: {{ $client_email }}</p>
                    <p>Quý khách vui lòng kiểm tra email để biết thêm thông tin.</p>

                </div>
            </div>
        </div>
@stop