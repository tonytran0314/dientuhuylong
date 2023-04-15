
		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
						<li id="category_parent"><a>Tất cả thế loại</a>
							<ul id="category_child">
								@foreach($categories_list as $category)
									<li><a href="{{ route('product.byCate', $category->slug) }}">{{ $category->name }}</a></li>
								@endforeach
							</ul>
						</li>
						<li><a href="#">Sản phẩm mới nhất</a></li>
						<li><a href="#">Giảm giá sốc</a></li>
						<li><a href="#">Liên hệ chúng tôi</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->