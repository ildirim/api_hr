<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class PasswordResetRequest extends BaseRequest
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
            'password' => 'required|required_with:confirmPassword|string|min:3|max:100',
            'confirmPassword' => 'required|string|min:3|max:100',
            'token' => 'required|string',
        ];
    }

    public function filters(): array
    {
        return [
            'password' => 'trim',
            'confirmPassword' => 'trim',
            "token" => "trim",
        ];
    }
}
