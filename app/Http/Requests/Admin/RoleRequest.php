<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class RoleRequest extends BaseRequest
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
        return $this->isMethod('POST') ? $this->store() : $this->update();
    }

    public function store(): array
    {
        return [
            'name' => 'required',
            'permissions' => 'array'
        ];
    }

    public function update(): array
    {
        return [
            'name' => 'required',
            'permissions' => 'array'
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Rol adı daxil edin",
            "name.unique" => "Rol adı unikal olmalıdır",
            "permissions.array" => "İcazələr array olaraq daxil edilməlidir",
        ];
    }

    public function filters(): array
    {
        return [
            'name' => 'trim',
        ];
    }
}
