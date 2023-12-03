<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class AnswerRequest extends BaseRequest
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
            'question_id' => 'required|integer|exists:questions,id',
            'is_correct' => 'required|integer',
            'name' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'question_id.required' => 'Sual daxil edin',
            'question_id.integer' => 'Sual rəqəm tipi olmalıdır',
            'question_id.exists' => 'Sual ID mövcud deyil',
            'is_correct.required' => 'Doğru cavabı daxil edin',
            'is_correct.integer' => 'Doğru cavab rəqəm olmalıdır',
            'name.required' => 'Cavab daxil edin',
            'name.max' => 'Cavab maksimal simvol sayı 255 ola bilər',
        ];
    }

    public function filters(): array
    {
        return [
            'question_id' => 'trim',
            'is_correct' => 'trim',
            'name' => 'trim',
        ];
    }
}
