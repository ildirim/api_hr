<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Rules\RequiredIfLanguageIsOne;

class JobSubcategoryRequest extends BaseRequest
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
            'jobCategoryId' => 'required|integer|exists:job_categories,id',
            'translations' => 'required|array',

            'translations.*.name' => ['required', new RequiredIfLanguageIsOne()],
            'translations.*.languageId' => 'required|numeric',

        ];
    }

    public function putValidation(): array
    {
        return [
            'jobCategoryId' => 'required|integer|exists:job_categories,id',
            'translations' => 'required|array',

            'translations.*.id' => '',
            'translations.*.name' => ['required', new RequiredIfLanguageIsOne()],
            'translations.*.languageId' => 'required|numeric',

        ];
    }

    public
    function messages(): array
    {
        return [
            'jobCategoryId.required' => 'Kateqoriya daxil edin',
            'jobCategoryId.integer' => 'Kateqoriya rəqəm tipi olmalıdır',
            'jobCategoryId.exists' => 'Kateqoriya ID mövcud deyil',
            'translations.*.name.required' => 'Ad daxil edin',
            'translations.*.name.max' => 'Ad maksimal 255 simvol ola bilər',
            'translations.*.languageId.required' => 'Dil daxil edin',
            'translations.*.languageId.numeric' => 'Dil rəqəm olmalıdır',
            'translations.*.languageId.exists' => 'Seçdiyiniz dil mövcud deyil',
        ];
    }

    public
    function filters(): array
    {
        return [
            'name' => 'trim',
        ];
    }
}
