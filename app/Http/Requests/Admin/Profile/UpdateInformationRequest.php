<?php

namespace App\Http\Requests\Admin\Profile;

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
            'fullname' => [
                'required',
                'regex:/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềếểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\?\%\x3B\/\.\;\&\(\)\-\+\"\'\d,\s]+)$/'
            ],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user_id)]
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Bạn phải nhập họ và tên',
            'fullname.regex' => 'Họ và tên chứa ký tự không được cho phép',
            'email.required' => 'Bạn phải nhập email',
            'email.email' => 'Bạn phải nhập email hợp lệ',
            'email.max' => 'Email không thể vượt quá 255 ký tự',
            'email.unique' => 'Email đã tồn tại'
        ];
    }
}
