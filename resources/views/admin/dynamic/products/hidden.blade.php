@extends('admin.layouts.template')

@section('title', 'Sản phẩm đã ẩn')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Danh sách sản phẩm đã ẩn</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">

                            @if (session('successMessage'))
                                <div class="alert alert-success">
                                    {{ session('successMessage') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Hình ảnh</th>
                                            <th>Giá sản phẩm</th>
                                            <th>Thuộc thể loại</th>
                                            <th colspan="2">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hiddenProducts as $hidden)
                                        <tr>
                                            <td>{{ $hidden->id }}</td>
                                            <td>{{ $hidden->name }}</td>
                                            <td><img src="{{ asset('storage/'.$hidden->image) }}" alt="Product Image" class="img-in-table"></td>
                                            <td>{{ $hidden->price }}</td>
                                            <td>{{ $hidden->category->name }}</td>

                                            <td class="text-center">
                                                <button value="{{ $hidden->id }}" class="btn btn-primary restore_product_button">Khôi phục</button>
                                            </td>

                                            <td class="text-center">
                                                <button class="btn btn-danger delete_product_button"  data-toggle="modal" data-target="#exampleModal" value="{{ $hidden->id }}">Xóa</button>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $hiddenProducts->links() }}
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->


    <!-- Form: restore product -->
    <form action="{{ route('product.admin.restore') }}" method="POST" id="restore_form">
        @csrf
        <input type="hidden" name="restore_product_id" id="restore_product_id">
    </form>
    <!-- /.Form: restore product -->


    <!-- Modal: confirm to delete product -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa vĩnh viễn sản phẩm này ?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Sau khi xóa vĩnh viễn sản phẩm này, bạn sẽ không thể khôi phục sản phẩm này. <br>
            Bạn có chắc muốn xóa không ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <form action="{{ route('product.admin.deleteProcess') }}" method="POST">
                    @csrf
                    <input type="hidden" name="delete_product_id" id="delete_product_id">
                    <button type="submit" class="btn btn-danger" id="confirm_delete_product_button">XÓA VĨNH VIỄN</button>
                </form>
            </div>
        </div>
        </div>
    </div>
    <!-- /.Modal: confirm to delete product -->

@stop