<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('dynamic.user.profile', [
            // 'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update_info(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->id)],
            'image' => ['image']
        ]);

        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $image = $request->current_image;

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->extension();
            $image = uniqid(). '.' .$extension;
            $request->image->move(public_path('storage'), $image);
        }

        User::where('id', $id)->update([
            'name' => $name,
            'email' => $email,
            'image' => $image
        ]);

        return Redirect::route('profile.edit')->with('successMessage', 'Đã cập nhật thông tin cá nhân thành công');
    }

    public function update_password(Request $request) {
        $request->validate([
            'current_password' => [
                'required', 
                'string', 
                'max:255', 
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        return $fail(__('Mật khẩu hiện tại không đúng'));
                    }
                }
            ],
            'new_password' => ['required', 'string', 'max:255', 'min:6', 'different:current_password'],
            'repeat_new_password' => ['required', 'string', 'max:255', 'same:new_password']
        ]);

        $id = $request->id;
        $new_password = $request->new_password;

        User::where('id', $id)->update([
            'password' => Hash::make($new_password)
        ]);

        return Redirect::route('profile.edit')->with('successMessage', 'Đã đổi mật khẩu thành công');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
