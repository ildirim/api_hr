<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
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
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            "email.required" => "Email daxil edin",
            "email.email" => "Email formatı düzgün deyil",
            "password.required" => "Şifrə daxil edin",
        ];
    }

    public function filters(): array
    {
        return [
            "email" => "trim",
            'password' => 'trim',
        ];
    }
}
