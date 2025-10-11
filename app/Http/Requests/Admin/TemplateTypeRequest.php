<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Http\Enums\PassingTypeEnum;
use App\Http\Enums\TimingEnum;
use Illuminate\Validation\Rule;

class TemplateTypeRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'hasSystemQuestions' => ['required', 'boolean'],
            'maxSystemQuestionCount' => ['required', 'integer'],
            'maxCustomQuestionCount' => ['required', 'integer'],
            'passingTypeCode' => ['required', 'integer', Rule::in(array_map(fn($e) => $e->value, PassingTypeEnum::cases()))],
            'timingCode' => ['nullable', 'integer', Rule::in(array_map(fn($e) => $e->value, TimingEnum::cases()))],
            'hasShuffleQuestions' => ['required', 'boolean'],
            'maxShuffledQuestionCount' => ['required', 'boolean'],
            'status' => ['required', 'integer'],
        ];
    }
}



