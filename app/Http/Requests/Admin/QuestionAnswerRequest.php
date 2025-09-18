<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Rules\RequiredIfLanguageIsOne;

class QuestionAnswerRequest extends BaseRequest
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
        return $this->isMethod('POST') ? $this->postValidation() : $this->putValidation();
    }

    public function postValidation(): array
    {
        return [
            'jobSubcategoryId' => 'required|integer|exists:job_subcategories,id',
            'questionCategoryId' => 'required|integer|exists:question_categories,id',
            'questionLevel' => 'required|integer',
            'period' => 'required|integer',

            'translations' => 'required|array',
            'translations.*.content' => ['required', 'max:2000', new RequiredIfLanguageIsOne()],
            'translations.*.languageId' => 'required|numeric',

            'answers' => 'array',
            'answers.*.isCorrect' => 'required|integer',

            'answers.*.translations' => 'required|array',
            'answers.*.translations.*.languageId' => 'required_if:is_default,true|numeric|exists:languages,id',
            'answers.*.translations.*.name' => 'required|max:255',
        ];
    }

    public function putValidation(): array
    {
        return [
            'jobSubcategoryId' => 'required|integer|exists:job_subcategories,id',
            'questionCategoryId' => 'required|integer|exists:question_categories,id',
            'questionLevel' => 'required|integer',
            'period' => 'required|integer',

            'translations' => 'required|array',
            'translations.*.id' => '',
            'translations.*.content' => 'required|max:2000',
            'translations.*.languageId' => 'required|numeric',

            'answers' => 'array',
            'answers.*.isCorrect' => 'required|integer',

            'answers.*.translations' => 'required|array',
            'answers.*.translations.*.id' => '',
            'answers.*.translations.*.languageId' => 'required_if:is_default,true|numeric|exists:languages,id',
            'answers.*.translations.*.name' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'jobSubcategoryId.required' => 'İş kateqoriyası daxil edin',
            'jobSubcategoryId.integer' => 'İş kateqoriyası rəqəm tipi olmalıdır',
            'jobSubcategoryId.exists' => 'İş kateqoriyası ID mövcud deyil',
            'questionCategoryId.required' => 'Sual kateqoriyası daxil edin',
            'questionCategoryId.integer' => 'Sual kateqoriyası rəqəm tipi olmalıdır',
            'questionCategoryId.exists' => 'Sual kateqoriyası ID mövcud deyil',
            'questionLevel.required' => 'Sual səviyyəsi daxil edin',
            'questionLevel.integer' => 'Sual səviyyəsi rəqəm olmalıdır',
            'period.required' => 'Müddət daxil edin',
            'period.integer' => 'Müddət rəqəm olmalıdır',
            'translations.*.content.required' => 'Məzmun daxil edin',
            'translations.*.content.max' => 'Məzmun maksimal 2000 simvol ola bilər',
            'translations.*.languageId.required' => 'Dil daxil edin',
            'translations.*.languageId.numeric' => 'Dil rəqəm olmalıdır',
            'translations.*.languageId.exists' => 'Seçdiyiniz dil mövcud deyil',
            'answers.*.isCorrect.required' => 'Doğru cavabı daxil edin',
            'answers.*.isCorrect.integer' => 'Doğru cavab rəqəm olmalıdır',
            'answers.*.translations.*.name.required' => 'Cavab daxil edin',
            'answers.*.translations.*.name.max' => 'Cavab maksimal simvol sayı 255 ola bilər',
        ];
    }

    public function filters(): array
    {
        return [
            'languageId' => 'trim',
            'jobSubcategoryId' => 'trim',
            'questionCategoryId' => 'trim',
            'questionLevel' => 'trim',
            'period' => 'trim',
            'content' => 'trim',
        ];
    }
}
