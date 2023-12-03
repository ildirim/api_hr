<?php

namespace App\Http\Requests\Hr;

use App\Http\Requests\BaseRequest;

class TemplateCategoryRequest extends BaseRequest
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
            'templateCategories' => 'required|array',

            'templateCategories.*.templateId' => 'required|integer|digits_between:1,11|exists:templates,id',
            'templateCategories.*.questionCategoryId' => 'required|integer|digits_between:1,11|exists:question_categories,id',
            'templateCategories.*.duration' => 'integer|digits_between:1,11',
            'templateCategories.*.isGrouped' => 'required|boolean',
            'templateCategories.*.questions' => 'required|array',
            'templateCategories.*.customQuestions' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'templateCategories.required' => 'Şablon kateqoriyası daxil edin',
            'templateCategories.array' => 'Şablon kateqoriyası massiv olmalıdır',

            'templateCategories.*.templateId.required' => 'Şablon daxil edin',
            'templateCategories.*.templateId.integer' => 'Şablon rəqəm tipi olmalıdır',
            'templateCategories.*.templateId.exists' => 'Şablon mövcud deyil',
            'templateCategories.*.templateId.digits_between' => 'Şablon maksimal 11 simvol ola bilər',
            'templateCategories.*.questionCategoryId.required' => 'Sual kateqoriyası daxil edin',
            'templateCategories.*.questionCategoryId.integer' => 'Sual kateqoriyası rəqəm tipi olmalıdır',
            'templateCategories.*.questionCategoryId.exists' => 'Sual kateqoriyası mövcud deyil',
            'templateCategories.*.questionCategoryId.digits_between' => 'Sual kateqoriyası maksimal 11 simvol ola bilər',
            'templateCategories.*.duration.integer' => 'Müddət rəqəm tipi olmalıdır',
            'templateCategories.*.duration.exists' => 'Müddət seçimi mövcud deyil',
            'templateCategories.*.isGrouped.required' => 'Qruplama daxil edin',
            'templateCategories.*.isGrouped.boolean' => 'Qruplama boolean olmalıdır',
            'templateCategories.*.questions.required' => 'Suallar daxil edin',
            'templateCategories.*.questions.array' => 'Suallar massiv olmalıdır',
            'templateCategories.*.customQuestions.required' => 'Manual suallar daxil edin',
            'templateCategories.*.customQuestions.array' => 'Manual suallar massiv olmalıdır',
        ];
    }

    public function filters(): array
    {
        return [
            'jobSubcategoryId' => 'trim',
            'languageId' => 'trim',
        ];
    }
}
