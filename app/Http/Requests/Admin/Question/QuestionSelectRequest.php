<?php

namespace App\Http\Requests\Admin\Question;

use App\Http\Requests\BaseRequest;

class QuestionSelectRequest extends BaseRequest
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
            'questionCategory' => '',
            'questionLevel' => '',
            'jobSubcategory' => '',
        ];
    }

    public function messages(): array
    {
        return [
        ];
    }

    public function filters(): array
    {
        return [
            'questionCategory' => 'trim',
            'questionLevel' => 'trim',
            'jobSubcategory' => 'trim',
        ];
    }
}
