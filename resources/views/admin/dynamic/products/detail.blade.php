@extends('admin.layouts.template')

@section('title', 'Chi tiết thể loại')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Chi tiết sản phẩm</h1>

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
                <p>{{ $detail->price }} VNĐ</p>
                <a href="{{ route('product.admin.edit', $detail->slug) }}" class="btn btn-warning text-dark">Sửa</a>
                <a href="#" class="btn btn-danger">Xóa</a>
            </div>
        </div>
    </div>

</div>
@stop