<?php

namespace App\Http\DTOs\Hr\Template\Request;

use App\Http\DTOs\CoreData;
use App\Http\Enums\PassingTypeEnum;
use App\Http\Enums\TemplateStatusEnum;
use App\Http\Enums\TimingEnum;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\DigitsBetween;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Optional;

class TemplateQuestionDto extends CoreData
{
    public int $status = TemplateStatusEnum::INCOMPLETED_STEP2->value;

    public function __construct(
        #[DigitsBetween(8000, 9000)]
        public int|Optional $passingTypeCode = PassingTypeEnum::CORRECT_QUESTIONS_COUNT->value,
        #[DigitsBetween(8000, 9000)]
        public int|Optional $timingCode = TimingEnum::TEMPLATE_BASE->value,
        #[DigitsBetween(1, 1000)]
        public int|Optional $passingScore = 0,
        #[DigitsBetween(1, 10000)]
        public int|Optional $duration = 0,
        #[DataCollectionOf(TemplateCategoryRequestDto::class)]
        public DataCollection $templateCategories,
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
