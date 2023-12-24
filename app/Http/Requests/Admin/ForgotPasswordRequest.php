<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class ForgotPasswordRequest extends BaseRequest
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
            'adminId' => 'required|integer|exists:admins,id',
            'phone' => 'string',
            'email' => 'string',
        ];
    }

    public function filters(): array
    {
        return [
            'phone' => 'trim',
            'email' => 'trim',
        ];
    }
}
