<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class RefreshTokenRequest extends BaseRequest
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
            'refresh_token' => 'required|string|size:64',
        ];
    }

    public function messages(): array
    {
        return [
            'refresh_token.required' => __('refresh_token_required'),
            'refresh_token.size' => __('refresh_token_invalid_format'),
        ];
    }
}
