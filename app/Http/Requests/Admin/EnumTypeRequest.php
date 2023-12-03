<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class EnumTypeRequest extends BaseRequest
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
            'name' => 'required|string|unique:enum_types,name',
            'target' => 'required|string',
            'lastNumber' => '',
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Ad daxil edin",
            "name.unique" => "Ad unikal olmalıdır",
            "target.required" => "Tip daxil edin",
        ];
    }

    public function filters(): array
    {
        return [
            'name' => 'trim',
            'target' => 'trim',
            'lastNumber' => 'trim',
        ];
    }
}
