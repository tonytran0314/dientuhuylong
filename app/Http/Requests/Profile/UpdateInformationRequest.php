<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UpdateInformationRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->id)],
            'image' => ['image']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn phải nhập họ và tên',
            'name.string' => 'Họ và tên chứa ký tự không được cho phép',
            'name.max' => 'Họ và tên không thể vượt quá 255 ký tự',
            'email.required' => 'Bạn phải nhập email',
            'email.email' => 'Bạn phải nhập email hợp lệ',
            'email.max' => 'Email không thể vượt quá 255 ký tự',
            'email.unique' => 'Email đã tồn tại',
            'image.image' => 'Bạn phải chọn 1 hình ảnh hợp lệ'
        ];
    }
}
