@extends('admin.layouts.template')

@section('title', 'Chỉnh sửa thể loại')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Chỉnh sửa thể loại</h1>

    <!-- DataTales Example -->
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

            

            <form action="{{ route('category.admin.editProcess') }}" method="POST" class="form-inline">
                @csrf
                <div class="form-group mx-sm-3 mb-2">
                    <label for="categoryName" class="mr-4">Tên thể loại</label>
                    <input type="text" class="form-control" name="name" id="categoryName" value="{{ $category->name }}">
                    <input type="hidden" name="id" value="{{ $category->id }}">
                </div>
                <button type="submit" name="save-change" class="btn btn-primary mb-2">Lưu thay đổi</button>
            </form>
        </div>
    </div>
    
</div>
@stop