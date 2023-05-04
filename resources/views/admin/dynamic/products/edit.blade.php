@extends('admin.layouts.template')

@section('title', 'Chỉnh sửa sản phẩm')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Chỉnh sửa sản phẩm</h1>

    <!-- Product Detail -->
    <div class="card shadow mb-4">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('product.admin.editProcess') }}" method="POST" class="d-flex flex-row justify-content-between" enctype="multipart/form-data">
                @csrf

                <div class="img-in-detail-container">

                    <div class="input-group mb-4">
                        {{-- <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Bạn muốn chọn hình ảnh mới ?</label>
                        </div> --}}
                        <div>
                            <input type="file" name="image">
                        </div>
                    </div>
                    <input type="hidden" value="{{ $detail->image }}" name="current_image">
                    <img src="{{ asset('storage/'.$detail->image) }}" alt="Product Image">
                </div>
                <div class="product-information-container"> 
                    <input type="hidden" name="id" value="{{ $detail->id }}">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" name="name" value="{{ $detail->name }}" class="form-control mb-4">
                    <label for="category">Thuộc thể loại</label>
                    <select class="form-control mb-4" aria-label="Default select example" id="category" name="category">
                        <option value="" disabled
                        
                        @if (!$detail->category)
                            selected
                        @endif

                        >Chọn 1 thể loại</option>

                        @foreach($allCategories as $category)
                            @if($detail->category)
                                @if($category->name == $detail->category->name)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="name">Giá sản phẩm</label>
                    <input type="text" name="price" value="{{ $detail->price }}" class="form-control mb-4">

                    <label for="description">Mô tả sản phẩm</label>
                    <textarea name="description" class="form-control mb-4" cols="30" rows="10">{{ $detail->description }}</textarea>

                    <button type="submit" name="save-change" class="btn btn-success">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>

</div>
@stop