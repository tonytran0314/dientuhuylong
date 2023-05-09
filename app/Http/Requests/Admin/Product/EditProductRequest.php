<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'name' => [
                'required',
                'regex:/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềếểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\?\%\x3B\/\.\;\&\(\)\-\+\"\'\d,\s]+)$/'
            ],
            'category' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'description' => [
                'required',
                'regex:/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềếểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\?\%\x3B\/\.\&\(\)\-\+\"\'\d,\s]+)$/'
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn phải nhập tên sản phẩm',
            'name.regex' => 'Tên sản phẩm chứa ký tự không được cho phép',
            'category.required' => 'Bạn phải chọn 1 thể loại cho sản phẩm',
            'price.required' => 'Bạn phải nhập giá sản phẩm',
            'description.required' => 'Bạn phải nhập mô tả sản phẩm',
            'description.regex' => 'Mô tả sản phẩm chứa ký tự không được cho phép'
        ];
    }
}
