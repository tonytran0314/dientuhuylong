@extends('admin.layouts.template')

@section('title', 'Admin Profile')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h3 class="h3 text-gray-800">
      Trang cá nhân quản trị viên
    </h3>
  </div>
    
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if (session('successMessage'))
    <div class="alert alert-success">
      {{ session('successMessage') }}
    </div>
  @endif

  <!-- Thông tin cá nhân -->
  <div class="card shadow mb-4">
    <div class="card-body">

      

      <div id="admin_info_update_container" class="container">
        <div class="row">
          <h4 class="h4 mb-4">Thông tin cá nhân</h4>
        </div>
        
        <form action="{{ route('profile.admin.infoUpdate') }}" method="POST" enctype="multipart/form-data">
          @csrf
        <div class="row">
          <input type="hidden" name="current_avatar" value="{{ Auth::user()->image }}">
          <input type="file" name="new_avatar" id="new_avatar" class="mb-4">
        </div>
        <div class="row">
          <div id="admin_avatar_container" class="mb-4 col-sm">
            <img 
              src="{{ asset('storage/'.Auth::user()->image) }}" 
              alt="user_avatar" 
              style="
                width: 300px;
                height: 300px;
                border-radius: 50%;
                object-fit: cover;
            ">
          </div>
          
          <div class="col-sm">
            <label for="fullname">Họ và tên</label>
            <input 
              type="text" 
              name="fullname" 
              id="fullname" 
              class="form-control mb-4"
              value="{{ Auth::user()->name }}"
              required>

            <label for="email">Email</label>
            <input 
              type="email" 
              name="email" 
              id="email" 
              class="form-control mb-4" 
              value="{{ Auth::user()->email }}"
              required>

            <input 
              type="hidden" 
              name="user_id" 
              value="{{ Auth::user()->id }}">

            <button type="submit" class="btn btn-primary ">Lưu thay đổi</button>
          </div>

        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Mật khẩu -->
  <div class="card shadow mb-4">
    <div class="card-body">

      <div id="admin_info_update_container" class="container">
        <h4 class="h4 mb-4">Mật khẩu</h4>
        <form action="{{ route('profile.admin.passwordUpdate') }}" method="POST">
          @csrf

          <label for="current_password">Mật khẩu hiện tại</label>
          <div class="input-group mb-4">
            <div class="password-toggle">
              <i class="fa fa-eye-slash" aria-hidden="true"></i>
            </div>
            <input type="password" name="current_password" id="current_password" class="password-input form-control" required>
          </div>

          <label for="new_password">Mật khẩu mới</label>
          <div class="input-group mb-4">
            <div class="password-toggle">
              <i class="fa fa-eye-slash" aria-hidden="true"></i>
            </div>
            <input type="password" name="new_password" id="new_password" class="password-input form-control" required>
          </div>

          <label for="confirm_new_password">Xác nhận mật khẩu mới</label>
          <div class="input-group mb-4">
            <div class="password-toggle">
              <i class="fa fa-eye-slash" aria-hidden="true"></i>
            </div>
            <input type="password" name="confirm_new_password" id="confirm_new_password" class="password-input form-control" required> 
          </div>

          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

          <button type="submit" class="btn btn-primary ">Đổi mật khẩu</button>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->


@stop