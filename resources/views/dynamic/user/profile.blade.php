@extends('layouts.master')

@section('title', 'Trang cá nhân')

@section('content')
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            @if (session('successMessage'))
            <div class="alert alert-success">
                {{ session('successMessage') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <!-- profile information  -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Thông tin cá nhân</h3>
                </div>
            </div>
            
            <div class="col-md-12 mb-4">
                <div class="col-md-4 avatar">
                    <form action="{{ route('profile.update.info') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="current_image" value="{{ Auth::user()->image }}">
                    <div class="input-group">
                        <input type="file" name="image" id="image">
                    </div>
                    <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="avatar">
                </div>
                <div class="col-md-8 profile_info">
                        <div class="form-group">
                            <label for="fullname">Họ và tên</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Địa chỉ email</label>
                            <input type="text" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
            <!-- Change password  -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Đổi mật khẩu</h3>
                </div>
            </div>
            <div class="col-md-12">
                <form action="{{ route('profile.update.password') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    
                    
                    <div class="form-group password-field">
                        <label for="current_password">Mật khẩu hiện tại</label>
                        <i class="fa fa-eye-slash"></i>
                        <input type="password" class="form-control" name="current_password" id="current_password">
                    </div>
                    <div class="form-group password-field">
                        <label for="new_password">Mật khẩu mới</label>
                        <i class="fa fa-eye-slash"></i>
                        <input type="password" class="form-control" name="new_password" id="new_password">
                    </div>
                    <div class="form-group password-field">
                        <label for="repeat_new_password">Xác nhận mật khẩu mới</label>
                        <i class="fa fa-eye-slash"></i>
                        <input type="password" class="form-control" name="repeat_new_password" id="repeat_new_password">
                    </div>
                    <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop