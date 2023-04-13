@extends('layouts.master')

@section('title', 'Giỏ hàng')

@section('content')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                @if($productCount > 0)
                {{-- PAGE TITLE --}}
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Giỏ hàng của bạn ({{ $productCount }} mặt hàng)</h3>
                    </div>
                </div>

                {{-- BODY  --}}
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2">Sản phẩm</th>
                                <th>Giá sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Tổng cộng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productsInCart as $product)
                            <tr>
                                <td><img src="{{ asset('storage/'.$product->image) }}" alt="product image" style="width: 200px"></td>
                                <td><a href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a></td>
                                <td>{{ number_format($product->price) }}</td>
                                
                                <td>
                                    <select class="quantity_in_cart">
                                        @for ($i = 1; $i <= 20; $i++)
                                            <option value="{{ $i }}"
                                                    data-product-user-id="{{ $product->pivot->id }}"
                                                    @if ($i == $product->pivot->quantity)
                                                        selected 
                                                    @endif > {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </td>
                                
                                <td>{{ number_format($product->price * $product->pivot->quantity) }}</td>
                                {{-- REMOVE PRODUCT FROM CART FORM --}}
                                <form action="{{ route('product.cart.remove') }}" method="POST">
                                <td>
                                        @csrf
                                        <input type="hidden" name="remove_product_user_id" value="{{ $product->pivot->id }}">
                                        <button class="btn btn-danger" type="submit">Loại bỏ</button>
                                </td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-5 pull-right total-box">
                    <div class="col-md-5">
                        <h3>Tổng cộng:</h3>
                    </div>
                    <div class="col-md-7 pull-right">
                        <h3>{{ number_format($totalPrice) }} VNĐ</h3>
                    </div>
                    <div class="col-md-12 checkout-button-container">
                        <a href="{{ route('product.checkout') }}" class="btn btn-success">Thanh toán</a>
                    </div>
                </div>
                @else
                    {{-- PAGE TITLE --}}
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title">Bạn chưa có sản phẩm nào trong giỏ hàng</h3>
                            <br><br>
                            <a href="{{ route('home') }}">Tiếp tục mua sắm</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <form action="{{ route('product.cart.edit') }}" method="POST" id="update_quantity_form">
        @csrf
        <input type="hidden" name="product_user_id" id="product_user_id">
        <input type="hidden" name="new_quantity" id="new_quantity">
    </form>

@stop