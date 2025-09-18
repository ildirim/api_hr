<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Rules\RequiredIfLanguageIsOne;

class TemplateRequest extends BaseRequest
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
            'jobSubcategoryId' => 'required|integer|digits_between:1,11|exists:job_subcategories,id',
            'languageId' => 'required|numeric',
            'planCode' => 'required|integer|digits_between:1,11', // enum
            'name' => ['between:3,100', new RequiredIfLanguageIsOne()],
            'timingCode' => 'integer|digits_between:1,11', // enum
            'duration' => 'integer|digits_between:1,11',
        ];
    }

    public function putValidation(): array
    {
        return [
            'jobSubcategoryId' => 'required|integer|digits_between:1,11|exists:job_subcategories,id',
            'languageId' => 'required|numeric',
            'planCode' => 'required|integer|digits_between:1,11',
            'name' => ['between:3,100', new RequiredIfLanguageIsOne()],
            'timingCode' => 'integer|digits_between:1,11',
            'duration' => 'integer|digits_between:1,11',
        ];
    }

    public
    function messages(): array
    {
        return [
            'jobSubcategoryId.required' => 'Kateqoriya daxil edin',
            'jobSubcategoryId.integer' => 'Kateqoriya rəqəm tipi olmalıdır',
            'jobSubcategoryId.exists' => 'Kateqoriya mövcud deyil',
            'jobSubcategoryId.digits_between' => 'Kateqoriya maksimal 11 simvol ola bilər',
            'languageId.required' => 'Dil daxil edin',
            'languageId.integer' => 'Dil rəqəm tipi olmalıdır',
            'languageId.exists' => 'Dil mövcud deyil',
            'languageId.digits_between' => 'Dil maksimal 11 simvol ola bilər',
            'planCode.required' => 'Plan daxil edin',
            'planCode.integer' => 'Plan rəqəm tipi olmalıdır',
            'planCode.exists' => 'Plan mövcud deyil',
            'planCode.digits_between' => 'Plan maksimal 11 simvol ola bilər',
            'name.required' => 'Şablon adı daxil edin',
            'name.string' => 'Şablon adı yazı tipi olmalıdır',
            'name.between' => 'Şablon adı maksimal 100 simvol ola bilər',
            'timingCode.required' => 'Vaxt seçimi daxil edin',
            'timingCode.integer' => 'Vaxt seçimi rəqəm tipi olmalıdır',
            'timingCode.exists' => 'Vaxt seçimi mövcud deyil',
            'duration.integer' => 'Müddət rəqəm tipi olmalıdır',
            'duration.exists' => 'Müddət seçimi mövcud deyil',
        ];
    }

    public
    function filters(): array
    {
        return [
            'jobSubcategoryId' => 'trim',
            'languageId' => 'trim',
            'planCode' => 'trim',
            'name' => 'trim',
            'timingCode' => 'trim',
            'duration' => 'trim',
        ];
    }
}
