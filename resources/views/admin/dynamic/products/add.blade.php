@extends('admin.layouts.template')

@section('title', 'Thêm sản phẩm')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Thêm sản phẩm</h1>

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

            <form action="{{ route('product.admin.addProcess') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    
                <label for="name">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control mb-4">

                <label for="category">Thuộc thể loại</label>
                <select class="form-control mb-4" aria-label="Default select example" id="category" name="category">
                    <option value="">--- Chọn 1 thể loại ---</option>
                    @foreach($allCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <label for="price">Giá sản phẩm</label>
                <input type="text" name="price" id="price" class="form-control mb-4">

                <div class="input-group mb-4">
                    <div>
                        <label for="image">Hình ảnh sản phẩm</label>
                        <br>
                        <input type="file" name="image" id="image">
                    </div>
                </div>

                <label for="description">Mô tả sản phẩm</label>
                <textarea name="description" class="form-control mb-4" cols="30" rows="10"></textarea>

                <button type="submit" name="save-change" class="btn btn-success">Thêm sản phẩm</button>
            </form>
        </div>
    </div>

</div>
@stop