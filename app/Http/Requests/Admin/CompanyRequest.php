<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class CompanyRequest extends BaseRequest
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
            'name' => 'unique:companies,name,required|string',
            'phone' => 'required|string',
            'image' => '',
            'address' => '',
            'website' => '',
            'about' => '',
            'status' => ''
        ];
    }

    public function messages(): array
    {
        return [
            "name.unique" => "Ad unikal olmalıdır",
            "name.required" => "Ad daxil edin",
            "phone.required" => "Nömrə daxil edin",
        ];
    }

    public function filters(): array
    {
        return [
            'name' => 'trim',
            'phone' => 'trim',
            'image' => 'trim',
            'address' => 'trim',
            'website' => 'trim',
            'about' => 'trim',
            'status' => 'trim'
        ];
    }
}
