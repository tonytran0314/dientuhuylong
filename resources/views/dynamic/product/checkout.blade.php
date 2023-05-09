@extends('layouts.master')

@section('title', 'Thanh toán')

@section('content')

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
					<div class="col-md-7">
                        <form action="{{ route('product.success_order') }}" method="POST">
                            @csrf
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Thông tin giao hàng</h3>
							</div>
							<div class="form-group">
								<label for="fullname">Họ và tên <span style="color:red;">*</span></label>
								<input class="input" type="text" name="fullname" id="fullname" required>
							</div>
							<div class="form-group">
								<label for="email">Email <span style="color:red;">*</span></label>
								<input class="input" type="text" name="email" id="email" required>
							</div>
							<div class="form-group">
								<label for="phone_number">Số điện thoại <span style="color:red;">*</span></label>
								<input class="input" type="text" name="phone_number" id="phone_number" required>
							</div>
							<div class="form-group">
								<label for="tp_tinh">Thành phố/Tỉnh <span style="color:red;">*</span></label>
								<select class="input" name="tp_tinh" id="tp_tinh" required>
									<option disabled selected>-Chọn Thành phố/Tỉnh-</option>
									@foreach($tinh_tp as $ttp)
										<option value="{{ $ttp->matp }}">{{ $ttp->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="quan_huyen">Quận/Huyện <span style="color:red;">*</span></label>
								<select class="input" name="quan_huyen" id="quan_huyen" disabled required>
									<option disabled selected>-Chọn Quận/Huyện-</option>
								</select>
							</div>
                            <div class="form-group">
								<label for="phuong_xa">Phường/Xã <span style="color:red;">*</span></label>
								<select class="input" name="phuong_xa" id="phuong_xa" disabled required>
									<option disabled selected>-Chọn Phường/Xã-</option>
								</select>
							</div>
                            <div class="form-group">
								<label for="number_road">Số nhà và tên đường <span style="color:red;">*</span></label>
								<input class="input" type="text" name="number_road" id="number_road" required>
							</div>
							{{-- <div class="form-group">  <div class="input-checkbox">
									<input type="checkbox" id="create-account">
									<label for="create-account">
										<span></span>
										Create Account?
									</label>
									<div class="caption">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
										<input class="input" type="password" name="password" placeholder="Enter Your Password">
									</div>
								</div> </div> --}}
						</div>
						<!-- /Billing Details -->
{{-- 
						<!-- Shiping Details -->
						<div class="shiping-details">
							<div class="section-title">
								<h3 class="title">Shiping address</h3>
							</div>
							<div class="input-checkbox">
								<input type="checkbox" id="shiping-address">
								<label for="shiping-address">
									<span></span>
									Ship to a diffrent address?
								</label>
								<div class="caption">
									<div class="form-group">
										<input class="input" type="text" name="first-name" placeholder="First Name">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="last-name" placeholder="Last Name">
									</div>
									<div class="form-group">
										<input class="input" type="email" name="email" placeholder="Email">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="address" placeholder="Address">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="city" placeholder="City">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="country" placeholder="Country">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
									</div>
									<div class="form-group">
										<input class="input" type="tel" name="tel" placeholder="Telephone">
									</div>
								</div>
							</div>
						</div>
						<!-- /Shiping Details --> --}}

						<!-- Order notes -->
						<div class="order-notes">
							<label for="notes">Ghi chú</label>
							<textarea class="input" name="notes" id="notes"></textarea>
						</div>
						<!-- /Order notes -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Đơn hàng của bạn</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>SẢN PHẨM</strong></div>
								<div><strong>TỔNG</strong></div>
							</div>
							<div class="order-products">
                                @foreach($productsInCart as $product)
                                    <div class="order-col">
                                        <div>{{ $product->pivot->quantity }}x {{ $product->name }}</div>
                                        <div>{{ number_format($product->price) }}</div>
                                    </div>
                                @endforeach
							</div>
							{{-- <div class="order-col">
								<div>Phí vận chuyển</div>
								<div><strong>50,000</strong></div>
							</div> --}}
							<div class="order-col">
								<div><strong>TỔNG CỘNG</strong></div>
								<div><strong class="order-total">{{ number_format($totalPrice) }} VNĐ</strong></div>
							</div>
						</div>
						{{-- <div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Direct Bank Transfer
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Cheque Payment
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Paypal System
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div> 
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>--}}
						<button type="submit" class="primary-btn order-submit">Xác nhận đặt hàng</button>
					</div>
					<!-- /Order Details -->
                    </form>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

@stop