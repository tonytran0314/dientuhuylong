<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
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
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'Bạn phải nhập mật khẩu hiện tại',
            'current_password.string' => 'Mật khẩu hiện tại chứa ký tự không được cho phép',
            'current_password.max' => 'Mật khẩu hiện tại không thể vượt quá 255 ký tự',
            'new_password.required' => 'Bạn phải nhập mật khẩu mới',
            'new_password.string' => 'Mật khẩu mới chứa ký tự không được cho phép',
            'new_password.max' => 'Mật khẩu mới không thể vượt quá 255 ký tự',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự',
            'new_password.different' => 'Mật khẩu mới không thể trùng với mật khẩu hiện tại',
            'repeat_new_password.required' => 'Bạn phải nhập xác nhận mật khẩu mới',
            'repeat_new_password.string' => 'Xác nhận mật khẩu mới chứa ký tự không được cho phép',
            'repeat_new_password.max' => 'Xác nhận mật khẩu mới không thể vượt quá 255 ký tự',
            'repeat_new_password.same' => 'Mật khẩu mới và Xác nhận mật khẩu mới không trùng nhau'
        ];
    }
}
