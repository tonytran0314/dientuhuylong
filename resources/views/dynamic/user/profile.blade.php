@extends('layouts.master')

@section('title', 'Trang cá nhân')

@section('content')
    <!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

                    {{-- profile information --}}
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Thông tin cá nhân</h3>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="col-md-4 avatar">
                            <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <input type="file" name="image" id="image">
                            </div>
                            <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="avatar">
                        </div>
                        <div class="col-md-8 profile_info">
                            
                                
                                <div class="form-group">
                                    <label for="fullname">Họ và tên</label>
                                    <input type="text" class="form-control" name="fullname" id="fullname" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Địa chỉ email</label>
                                    <input type="text" class="form-control" id="email" value="{{ Auth::user()->email }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </form>
                        </div>
                    </div>
                    {{-- Change password --}}
                    <div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Đổi mật khẩu</h3>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="current_password">Mật khẩu hiện tại</label>
                                <input type="text" class="form-control" name="current_password" id="current_password">
                            </div>
                            <div class="form-group">
                                <label for="new_password">Mật khẩu mới</label>
                                <input type="text" class="form-control" name="new_password" id="new_password">
                            </div>
                            <div class="form-group">
                                <label for="repeat_new_password">Xác nhận mật khẩu mới</label>
                                <input type="text" class="form-control" name="repeat_new_password" id="repeat_new_password">
                            </div>
                            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@stop