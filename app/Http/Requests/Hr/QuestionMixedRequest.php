<?php

namespace App\Http\Requests\Hr;

use App\Http\Requests\BaseRequest;
use App\Rules\RequiredIfLanguageIsOne;

class QuestionMixedRequest extends BaseRequest
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
            'jobSubcategoryId' => 'required',
            'languageId' => 'required|numeric',
            'companyId' => ['required', 'integer', new RequiredIfLanguageIsOne()],
        ];
    }

    public function messages(): array
    {
        return [
            'jobSubcategoryId.required' => 'İş kateqoriyası daxil edin',
            'languageId.required' => 'Dil daxil edin',
            'companyId.required' => 'Dil daxil edin',
        ];
    }

    public function filters(): array
    {
        return [
            'jobSubcategoryId' => 'trim',
            'languageId' => 'trim',
            'companyId' => 'trim',
        ];
    }
}
