@extends('layouts.master')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-6 bg-dark">
						<div id="product-main-img">
							<div class="product-preview">
								<img src="{{ asset('storage/'.$detail->image) }}" alt="">
							</div>
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<!-- {{-- <div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							<div class="product-preview">
								<img src="./img/product01.png" alt="">
							</div>

							<div class="product-preview">
								<img src="./img/product03.png" alt="">
							</div>

							<div class="product-preview">
								<img src="./img/product06.png" alt="">
							</div>

							<div class="product-preview">
								<img src="./img/product08.png" alt="">
							</div>
						</div>
					</div> --}} -->
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-6">
						<div class="product-details">
							<h2 class="product-name">{{ $detail->name }}</h2>
							<!-- {{-- <div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<a class="review-link" href="#">10 Review(s) | Add your review</a>
							</div> --}} -->
							<div>
								<h3 class="product-price">{{ number_format($detail->price) }} VNĐ
									<!-- {{-- <del class="product-old-price">$990.00</del> --}} -->
								</h3>
								<!-- {{-- <span class="product-available">In Stock</span> --}} -->
							</div>
							<p>{{ $detail->description }}</p>

							<!-- {{-- <div class="product-options">
								<label>
									Size
									<select class="input-select">
										<option value="0">X</option>
									</select>
								</label>
								<label>
									Color
									<select class="input-select">
										<option value="0">Red</option>
									</select>
								</label>
							</div> --}} -->

							<form action="{{ route('product.cart.add') }}" method="POST" id="detail_add_to_cart_form">
								@csrf
								<div class="add-to-cart">
									<div class="qty-label">
										Số lượng
										<div class="input-number">
											<input type="number" name="quantity">
											<span class="qty-up">+</span>
											<span class="qty-down">-</span>
										</div>
									</div>
									@auth
									<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
									<input type="hidden" name="to_cart_product_id" value="{{ $detail->id }}">
									@endauth
									<button submit class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> thêm vào giỏ hàng</button>
								</div>
							</form>

							{{-- <ul class="product-btns">
								<li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
								<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
							</ul> --}}

							<ul class="product-links">
								<li>Category:</li>
								<li><a href="{{ route('product.byCate', $detail->category->slug) }}">{{ $detail->category->name }}</a></li>
							</ul>

							{{-- <ul class="product-links">
								<li>Share:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul> --}}

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					{{-- <div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
								<li><a data-toggle="tab" href="#tab2">Details</a></li>
								<li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
										</div>
									</div>
								</div>
								<!-- /tab2  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span>4.5</span>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
													</div>
												</div>
												<ul class="rating">
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 80%;"></div>
														</div>
														<span class="sum">3</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 60%;"></div>
														</div>
														<span class="sum">2</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
												</ul>
											</div>
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">
													<li>
														<div class="review-heading">
															<h5 class="name">John</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
														</div>
													</li>
													<li>
														<div class="review-heading">
															<h5 class="name">John</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
														</div>
													</li>
													<li>
														<div class="review-heading">
															<h5 class="name">John</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
														</div>
													</li>
												</ul>
												<ul class="reviews-pagination">
													<li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#">4</a></li>
													<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
												</ul>
											</div>
										</div>
										<!-- /Reviews -->

										<!-- Review Form -->
										<div class="col-md-3">
											<div id="review-form">
												<form class="review-form">
													<input class="input" type="text" placeholder="Your Name">
													<input class="input" type="email" placeholder="Your Email">
													<textarea class="input" placeholder="Your Review"></textarea>
													<div class="input-rating">
														<span>Your Rating: </span>
														<div class="stars">
															<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
															<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
															<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
															<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
															<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
														</div>
													</div>
													<button class="primary-btn">Submit</button>
												</form>
											</div>
										</div>
										<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div> --}}
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Related Products</h3>
						</div>
					</div>
					@foreach($relatedProducts as $related_product)
					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="{{ asset('storage/'.$related_product->image) }}" alt="">
								<div class="product-label">
									<span class="sale">-30%</span>
								</div>
							</div>
							<div class="product-body">
								<p class="product-category">{{ $related_product->category->name }}</p>
								<h3 class="product-name"><a href="{{ route('product.detail', $related_product->slug) }}">{{ $related_product->name }}</a></h3>
								<h4 class="product-price">{{ number_format($related_product->price) }} VNĐ
									{{-- <del class="product-old-price">$990.00</del> --}}
								</h4>
								{{-- <div class="product-rating">
								</div> --}}
								{{-- <div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div> --}}
							</div>
							<div class="add-to-cart">
								{{-- ADD PRODUCT TO CART FORM --}}
								{{-- FOR RELATED PRODUCTS --}}
								<form action="{{ route('product.cart.add') }}" method="POST" id="add_to_cart_form">
									@csrf
									@auth
									<input type="hidden" name="to_cart_product_id" value="{{ $related_product->id }}">
									<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
									<input type="hidden" name="quantity" value="1">
									@endauth
									<button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
								</form>
							</div>
						</div>
					</div>
					<!-- /product -->
					@endforeach

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->

		
		<div class="section">
			<div class="container">
				<div class="row bootstrap snippets bootdeys">
					<div class="row">
						<div class="comment-wrapper col-md-12">
							<div class="panel">
								<div class="col-md-12">
									<div class="section-title text-center">
										<h3 class="title">Bình luận</h3>
									</div>
								</div>
								<div class="panel-body">
									@auth
									<form action="{{ route('comment.add') }}" method="POST">
										@csrf
										<textarea class="form-control" placeholder="Viết bình luận..." rows="3" name="content"></textarea>
										<input type="hidden" name="product_id" value="{{ $detail->id }}">
										<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
										<input type="hidden" name="product_slug" value="{{ $detail->slug }}">
										<br>
										<button type="submit" name="submit_comment_button" class="btn btn-info pull-right">Post</button>
										<div class="clearfix"></div>
									</form>
									@endauth
									
									<ul class="media-list">
										
										@foreach ($comments as $comment)
										<hr>
										<li class="media">
											<a href="#" class="pull-left">
												<img src="{{ asset('storage/'.$comment->user->name) }}" alt="" class="img-circle">
											</a>
											<div class="media-body">
												@auth
												@if ($comment->user->id == Auth::user()->id)
												<span class="text-muted pull-right">

													<button 
														type="button" 
														class="btn btn-primary update_comment_button" 
														data-toggle="modal" 
														data-target="#edit_comment_modal"
														data-content="{{ $comment->content }}"
														data-comment-id="{{ $comment->id }}">Sửa</button>

													<button 
														type="button" 
														class="btn btn-danger delete_comment_button" 
														data-toggle="modal" 
														data-target="#delete_comment_modal"
														data-comment-id="{{ $comment->id }}">Xóa</button>

												</span>
												@endif
												@endauth
												<strong class="text-primary">{{ $comment->user->name }}</strong>
												<p>
													{{ $comment->content }}
												</p>
											</div>
										</li>
										@endforeach
									</ul>
									{{ $comments->links() }}
								</div>
							</div>
						</div>
				
					</div>
				</div>
			</div>
		</div>


@auth
		<!-- Edit Comment Modal -->
<div class="modal fade" id="edit_comment_modal" tabindex="-1" role="dialog" aria-labelledby="edit_comment_modal_label" aria-hidden="true">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="edit_comment_modal_label">Chỉnh sửa bình luận</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form action="{{ route('comment.edit') }}" method="POST">
				@csrf
				<label for="update_content">Nội dung bình luận</label>
				<textarea name="update_content" id="update_content" cols="73" rows="10"></textarea>
				<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
				<input type="hidden" name="product_id" value="{{ $detail->id }}">
				<input type="hidden" name="product_slug" value="{{ $detail->slug }}">
				<input type="hidden" name="comment_id" id="comment_id">
		</div>
		<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
				<button type="submit" id="confirm_update_comment_button" class="btn btn-primary">Lưu thay đổi</button>
			</form>
		</div>
	</div>
	</div>
</div>



<!-- Delete Comment Modal -->
<div class="modal fade" id="delete_comment_modal" tabindex="-1" role="dialog" aria-labelledby="delete_comment_modal_label" aria-hidden="true">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="delete_comment_modal_label">Xóa bình luận</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<p>Bạn có chắc muốn xóa bình luận này không? Sau khi xóa, bạn không thể khôi phục bình luận</p>
		</div>
		<div class="modal-footer">
			<form action="{{ route('comment.delete') }}" method="POST">
				@csrf
				<input type="hidden" name="product_slug" value="{{ $detail->slug }}">
				<input type="hidden" name="delete_comment_id" id="delete_comment_id">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
				<button type="submit" class="btn btn-danger">Xóa</button>
			</form>
		</div>
	</div>
	</div>
</div>
		@endauth

@stop