@extends('admin.layouts.template')

@section('title', 'Danh sách sản phẩm')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-2 text-gray-800">Danh sách sản phẩm ({{ $productCount }} sản phẩm)</h1>
                        <a href="{{ route('product.admin.add') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Thêm sản phẩm</a>
                    </div>
                    

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
                                            <th colspan="3">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allProducts as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td><img src="{{ asset('storage/'.$product->image) }}" alt="Product Image" class="img-in-table"></td>
                                            <td>{{ $product->price }}</td>
                                            <td>
                                                @if ($product->category)
                                                    <a href="{{ route('product.admin.byCategory', $product->category->id) }}">{{ $product->category->name }}</a>
                                                @else
                                                    {{ __('Không xác định thể loại') }}
                                                @endif   
                                            </td>
                                            <td class="text-center"><a href="{{ route('product.admin.detail', $product->slug) }}" class="btn btn-info">Xem</a></td>
                                            <td class="text-center"><a href="{{ route('product.admin.edit', $product->slug) }}" class="btn btn-warning text-dark">Sửa</a></td>
                                            <td class="text-center"><button class="btn btn-secondary hide_product_button"  data-toggle="modal" data-target="#exampleModal" value="{{ $product->id }}">Ẩn</button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $allProducts->links() }}
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
                    <input type="hidden" name="product_id" id="product_id">
                    <button type="submit" class="btn btn-primary" id="confirm_hide_product_button">Ẩn</button>
                </form>
            </div>
        </div>
        </div>
    </div>
    <!-- /.Modal: confirm to delete product -->

@stop