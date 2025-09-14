<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class ConfirmPasswordRequest extends BaseRequest
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
            'email' => 'required|string|email|min:3|max:100|unique:admins,email',
            'phone' => 'required|string|size:13|unique:admins,phone',
            'password' => 'required|string|min:3|max:100',
            'confirmPassword' => 'required|string|min:3|max:100|same:password',
        ];
    }

    public function filters(): array
    {
        return [
            'password' => 'trim',
            'confirmPassword' => 'trim',
        ];
    }
}
