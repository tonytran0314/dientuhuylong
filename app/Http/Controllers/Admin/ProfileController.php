<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\Admin\Profile\UpdateInformationRequest;
use App\Http\Requests\Admin\Profile\UpdatePasswordRequest;

class ProfileController extends Controller
{
    public function show() {
        return view('admin.dynamic.admin_profile');
    }

    public function infoUpdate(UpdateInformationRequest $request) {
        $request->validated($request->all());

        $user_id = $request->user_id;
        $fullname = $request->fullname;
        $email = $request->email;
        $avatar = $request->current_avatar;

        if ($request->hasFile('new_avatar')) {
            $extension = $request->file('new_avatar')->extension();
            $avatar = uniqid(). '.' .$extension;
            $request->new_avatar->move(public_path('storage'), $avatar);
        } 

        User::where('id', $user_id)->update([
            'name' => $fullname,
            'email' => $email,
            'image' => $avatar
        ]);

        return Redirect::route('profile.admin')->with('successMessage', 'Đã cập nhật thông tin cá nhân thành công');
    }

    public function passwordUpdate(UpdatePasswordRequest $request) {
        $request->validated($request->all());

        $user_id = $request->user_id;
        $new_password = $request->new_password;

        User::where('id', $user_id)->update([
            'password' => Hash::make($new_password)
        ]);

        return Redirect::route('profile.admin')->with('successMessage', 'Đã đổi mật khẩu thành công');
    }
}
