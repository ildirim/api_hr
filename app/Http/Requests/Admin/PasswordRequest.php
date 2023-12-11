<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class PasswordRequest extends BaseRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'required|string|min:4',
        ];
    }

//    public function messages(): array
//    {
//        return [
//            'password.required' => 'Ad daxil edin',
//        ];
//    }

    public function filters(): array
    {
        return [
            'password' => 'trim',
        ];
    }
}
