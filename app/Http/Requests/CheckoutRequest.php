<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'fullname' => ['required', 'max:255', 'min:5'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'numeric'],
            'tp_tinh' => ['required'],
            'quan_huyen' => ['required'],
            'phuong_xa' => ['required'],
            'number_road' => ['required', 'max:255'],
            'notes' => ['max:255']
        ];
    }
}
