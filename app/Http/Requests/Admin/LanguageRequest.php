<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class LanguageRequest extends BaseRequest
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
            'name' => 'required|string',
            'locale' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ad daxil edin',
            'locale.required' => 'Locale daxil edin',
        ];
    }

    public function filters(): array
    {
        return [
            'name' => 'trim',
            'locale' => 'trim',
        ];
    }
}
