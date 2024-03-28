<?php

namespace App\Http\Requests\Hr;

use App\Http\Requests\BaseRequest;

class CustomQuestionAnswerRequest extends BaseRequest
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
            'templateId' => 'required|integer|digits_between:1,11|exists:templates,id',
            'languageId' => 'required|integer|digits_between:1,11|exists:languages,id',
            'content' => 'required|max:2000',

            'answers' => 'array',
            'answers.*.isCorrect' => 'required|integer|digits_between:1,4',
            'answers.*.name' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'templateId.required' => 'Şablon daxil edin',
            'templateId.integer' => 'Şablon rəqəm tipi olmalıdır',
            'templateId.exists' => 'Şablon mövcud deyil',
            'templateId.digits_between' => 'Şablon maksimal 11 simvol ola bilər',
            'languageId.required' => 'Dil daxil edin',
            'languageId.integer' => 'Dil rəqəm tipi olmalıdır',
            'languageId.exists' => 'Dil mövcud deyil',
            'languageId.digits_between' => 'Dil maksimal 11 simvol ola bilər',
            'content.required' => 'Məzmun daxil edin',
            'content.max' => 'Məzmun maksimal 2000 simvol ola bilər',

            'answers.*.isCorrect.required' => 'Doğru cavabı daxil edin',
            'answers.*.isCorrect.integer' => 'Doğru cavab rəqəm olmalıdır',
            'answers.*.isCorrect.digits_between' => 'Doğru cavab maksimal 4 simvol ola bilər',
            'answers.*.name.required' => 'Cavab daxil edin',
            'answers.*.name.max' => 'Cavab maksimal simvol sayı 255 ola bilər',
        ];
    }

    public function filters(): array
    {
        return [
            'name' => 'trim',
        ];
    }
}
