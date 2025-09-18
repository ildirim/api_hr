<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Rules\RequiredIfLanguageIsOne;

class QuestionRequest extends BaseRequest
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
            'language_id' => 'required|numeric',
            'job_subcategory_id' => 'required|integer|exists:job_subcategories,id',
            'question_category_id' => 'required|integer|exists:question_categories,id',
            'question_level' => ['required', 'integer', new RequiredIfLanguageIsOne()],
            'period' => 'required|integer',
            'content' => 'required|max:2000',
            'answers' => 'array'
        ];
    }

    public function messages(): array
    {
        return [
            'language_id.required' => 'Dil daxil edin',
            'language_id.integer' => 'Dil rəqəm tipi olmalıdır',
            'language_id.exists' => 'Dil ID mövcud deyil',
            'job_subcategory_id.required' => 'İş kateqoriyası daxil edin',
            'job_subcategory_id.integer' => 'İş kateqoriyası rəqəm tipi olmalıdır',
            'job_subcategory_id.exists' => 'İş kateqoriyası ID mövcud deyil',
            'question_category_id.required' => 'Sual kateqoriyası daxil edin',
            'question_category_id.integer' => 'Sual kateqoriyası rəqəm tipi olmalıdır',
            'question_category_id.exists' => 'Sual kateqoriyası ID mövcud deyil',
            'question_level.required' => 'Sual səviyyəsi daxil edin',
            'question_level.integer' => 'Sual səviyyəsi rəqəm olmalıdır',
            'period.required' => 'Müddət daxil edin',
            'period.integer' => 'Müddət rəqəm olmalıdır',
            'content.required' => 'Məzmun daxil edin',
            'content.max' => 'Məzmun maksimal simvol sayı 2000 ola bilər',
        ];
    }

    public function filters(): array
    {
        return [
            'language_id' => 'trim',
            'job_subcategory_id' => 'trim',
            'question_category_id' => 'trim',
            'question_level' => 'trim',
            'period' => 'trim',
            'content' => 'trim',
        ];
    }
}
