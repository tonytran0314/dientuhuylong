@extends('admin.layouts.template')

@section('title', 'Chi tiết thể loại')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Chi tiết sản phẩm</h1>
        <a href="{{ route('product.admin.add') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Thêm sản phẩm
        </a>
    </div>

    <!-- Product Detail -->
    <div class="card shadow mb-4">
        <div class="card-body d-flex flex-row justify-content-between">
            <div class="img-in-detail-container">
                <img src="{{ asset('storage/'.$detail->image) }}" alt="">
            </div>
            <div class="product-information-container">
                <h2 class="h4 text-gray-800">{{ $detail->name }}</h2>
                <h2 class="h5 text-gray-800">
                    @if ($detail->category)
                        {{ $detail->category->name }}
                    @else
                        {{ __('Không xác định thể loại') }}
                    @endif   
                </h2>
                <p>{{ number_format($detail->price) }} VNĐ</p>
                <p>{{ $detail->description }}</p>
                <a href="{{ route('product.admin.edit', $detail->slug) }}" class="btn btn-warning text-dark">Sửa</a>
                <button class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">Ẩn</button>
            </div>
        </div>
    </div>

    <!-- Modal: confirm to hide product -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn ẩn sản phẩm này ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                Sau khi ẩn sản phẩm sẽ không được hiển thị với người dùng. <br>Bạn có thể bỏ ẩn sản phẩm tại mục "Sản phẩm bị ẩn".
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <form action="{{ route('product.admin.hideProcess') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $detail->id }}" >
                        <button type="submit" class="btn btn-primary" id="confirm_hide_product_button">Ẩn</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.Modal: confirm to hide product -->

</div>
@stop