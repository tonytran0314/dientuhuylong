@extends('admin.layouts.template')

@section('title', 'Danh sách thể loại')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-2 text-gray-800">Danh sách thể loại ({{ $categoryCount }} thể loại)</h1>
                        <a href="{{ route('category.admin.add') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Thêm thể loại</a>
                    </div>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">

                            @if (session('successMessage'))
                                <div class="alert alert-success">
                                    {{ session('successMessage') }}
                                </div>
                            @endif

                            @if (session('errorMessage'))
                                <div class="alert alert-danger">
                                    {{ session('errorMessage') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên thể loại</th>
                                            <th>Số lượng sản phẩm</th>
                                            <th colspan="2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach($allCategories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td><a href="{{ route('product.admin.byCategory', $category->id) }}">{{ $category->name }}</a></td>
                                            <td>{{ $category->products->count() }}</td>
                                            <td class="text-center"><a href="{{ route('category.admin.edit', $category->slug) }}" class="btn btn-warning text-dark">Sửa</a></td>
                                            <td class="text-center"><button class="btn btn-danger delete_category_button"  data-toggle="modal" data-target="#exampleModal" value="{{ $category->id }}"
                                            data-product-count = "{{ $category->products->count() }}">Xóa</button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $allCategories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

    <!-- Modal: confirm to delete product -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa thể loại này ?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Sau khi xóa bạn sẽ không thể khôi phục thể loại đã xóa.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <form action="{{ route('category.admin.deleteProcess') }}" method="POST">
                    @csrf
                    <input type="hidden" name="category_id" id="category_id">
                    <input type="hidden" name="product_count" id="product_count">
                    <button type="submit" class="btn btn-danger" id="confirm_delete_category_button">Xóa</button>
                </form>
            </div>
        </div>
        </div>
    </div>
    <!-- /.Modal: confirm to delete product -->
@stop