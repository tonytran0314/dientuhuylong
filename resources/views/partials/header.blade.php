		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<!-- <ul class="header-links pull-left">
						<li>
							<a href="#"><i class="fa fa-phone"></i> 
								---- --- ---
							</a>
						</li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> giahuy.mailer@gmail.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> Chợ Gạo, Tiền Giang</a></li>
					</ul> -->
					<ul class="header-links pull-right">
						@auth
							@role ('admin')
								<li><a href="{{ route('dashboard') }}">Trang quản trị</a></li>
							@endrole
							@role ('user')
								<li><a href="{{ route('profile.edit') }}">Trang cá nhân</a></li>
							@endrole
							<form method="POST" action="{{ route('logout') }}">
								@csrf
								<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
									this.closest('form').submit();">Đăng xuất</a></li>
							</form>
						@else
							<li><a href="{{ route('login') }}">Đăng nhập</a></li>
							<li><a href="{{ route('register') }}">Đăng ký</a></li>
						@endauth
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="{{ route('home') }}" class="logo">
									{{-- <img src="{{ asset('client/img/logo.png') }}" alt=""> --}}
									<h1 style="color: white; padding-top:15px;">HuyLong</h1>
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="{{ route('product.search') }}" method="POST">
									@csrf
									{{-- <select class="input-select">
										<option value="0">All Categories</option>
										<option value="1">Category 01</option>
										<option value="1">Category 02</option>
									</select> --}}
									<input class="input" type="text" name="search_keyword" placeholder="Hôm nay bạn muốn tìm kiếm gì">
									<button type="submit" class="search-btn">Tìm kiếm</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								{{-- <div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div> --}}
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									{{-- <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> --}}
									<a href="{{ route('product.cart.show') }}">
										<i class="fa fa-shopping-cart"></i>
										<span>Giỏ hàng</span>


										@auth
										<!-- cái này nhìn vừa ảo vừa tà :)) 
										nhưng cái này chỉ nên là phương án tạm thời nên thay bằng ajax -->
										@php($num_of_item = App\Models\ProductUser::where('user_id', Auth::user()->id)->sum('quantity'))
										<div class="qty">{{ $num_of_item }}</div>
										@endauth


									</a>
									{{-- <div class="cart-dropdown">
										<div class="cart-list">
											<div class="product-widget">
												<div class="product-img">
													<img src="{{ asset('client/img/product01.png') }}" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>

											<div class="product-widget">
												<div class="product-img">
													<img src="{{ asset('client/img/product02.png') }}" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
										</div>
										<div class="cart-summary">
											<small>3 Item(s) selected</small>
											<h5>SUBTOTAL: $2940.00</h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
											<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div> --}}
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->