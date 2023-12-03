<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class AdminRequest extends BaseRequest
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
            'created_admin_id' => 'required|integer|exists:admins,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:admins,email',
            'password' => 'required|string|min:4',
            'phone' => '',
            'profile_image' => '',
            'status' => '',
            'roles' => 'array'
        ];
    }

    public function update(): array
    {
        return [
            'created_admin_id' => 'required|integer|exists:admins,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:admins,email,' . $this->id,
            'password' => '',
            'phone' => '',
            'profile_image' => '',
            'status' => '',
            'roles' => 'array'
        ];
    }

    public function messages(): array
    {
        return [
            'created_admin_id.required' =>  'Admin daxil edin',
            'created_admin_id.integer' =>  'Admin rəqəm tipi olmalıdır',
            'created_admin_id.exists' =>  'Admin mövcud deyil',
            'first_name.required' => 'Ad daxil edin',
            'first_name.string' => 'Ad string tipi olmalıdır',
            'last_name.required' => 'Soyad daxil edin',
            'last_name.string' => 'Soyad string tipi olmalıdır',
            'email.required' => 'E-poçt daxil edin',
            'email.string' => 'E-poçt string tipi olmalıdır',
            'email.email' => 'E-poçt formatı düzgün deyil',
            'email.unique' => 'Qeyd edilen e-poçt ilə qeydiyyat mövcuddur',
            'password.required' => 'Şifrə daxil edin',
            'password.string' => 'Şifrə string tipi olmalıdır',
            'password.email' => 'Şifrə formatı düzgün daxil edilməyib',
            'roles.array' => 'Rol array tipində olmalıdır',
        ];
    }

    public function filters(): array
    {
        return [
            'created_admin_id' => 'trim',
            'first_name' => 'trim',
            'last_name' => 'trim',
            'email' => 'trim',
            'password' => 'trim',
            'phone' => 'trim',
            'image' => 'trim',
            'status' => 'trim'
        ];
    }
}
