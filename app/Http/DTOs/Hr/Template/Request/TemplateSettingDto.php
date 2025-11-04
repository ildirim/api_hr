<?php

namespace App\Http\DTOs\Hr\Template\Request;

use App\Http\DTOs\CoreData;
use App\Http\Enums\PassingTypeEnum;
use App\Http\Enums\TemplateStepEnum;
use App\Http\Enums\TimingEnum;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Optional;

class TemplateSettingDto extends CoreData
{
    public int $step = TemplateStepEnum::STEP3_CONFIGURATION->value;

    public function __construct(
        #[Between(8000, 9000)]
        public int|Optional $passingTypeCode = PassingTypeEnum::CORRECT_ANSWERS_COUNT->value,
        #[Between(6000, 7000)]
        public int|Optional $timingCode = TimingEnum::TEMPLATE_BASE->value,
        #[Between(1, 1000)]
        public null|int|Optional $passingScore = 0,
        #[Between(1, 10000)]
        public null|int|Optional $duration = 0,
    ) {
    }

    public static function messages(): array
    {
        return [
            'questionIds.required' => 'Suallar daxil edilməyib',
            'questionIds.array_type' => 'Suallar daxil edilməyib',
            'passingTypeCode.required' => 'Passing type daxil edin',
            'passingTypeCode.digits_between' => 'Passing type kodu düzgün daxil edilməyib',
            'passingScore.integer' => 'Passing score rəqəm tipi olmalıdır',
            'passingScore.digits_between' => 'Passing score kodu düzgün daxil edilməyib',
            'name.required' => 'Şablon adı daxil edin',
            'duration.integer' => 'Müddət rəqəm tipi olmalıdır',
            'duration.digits_between' => 'Müddət maksimal 10000 ola bilər',
        ];
    }
}
