
		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="{{ route('home') }}">Home</a></li>
						<li id="category_parent"><a>Tất cả thế loại</a>
							<ul id="category_child">
								@foreach($categories_list as $category)
									<li><a href="{{ route('product.byCate', $category->slug) }}">{{ $category->name }}</a></li>
								@endforeach
							</ul>
						</li>
						<li><a href="{{ route('product.byCate', 'noi-chien-khong-dau') }}">Nồi chiên không dầu</a></li>
						<li><a href="{{ route('product.byCate', 'tivi') }}">Tivi</a></li>
						<li><a href="{{ route('product.byCate', 'loa') }}">Loa</a></li>
						<li><a href="{{ route('product.byCate', 'ban-phim') }}">Bàn phím</a></li>
						<li><a href="{{ route('product.byCate', 'chuot-may-tinh') }}">Chuột máy tính</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->