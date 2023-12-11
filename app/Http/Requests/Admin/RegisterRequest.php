<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
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
            'firstName' => 'required|string|min:3|max:100',
            'lastName' => 'required|string|min:3|max:100',
            'email' => 'required|string|email|min:3|max:100|unique:admins,email',
            'phone' => 'required|string|max:20|unique:admins,phone',
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
            'firstName' => 'trim',
            'lastName' => 'trim',
            "email" => "trim",
            "phone" => "trim",
        ];
    }
}
