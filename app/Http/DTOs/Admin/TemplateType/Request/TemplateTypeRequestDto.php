<?php

namespace App\Http\DTOs\Admin\TemplateType\Request;

use App\Http\DTOs\CoreData;
use App\Http\Enums\ActivationStatusEnum;
use App\Http\Enums\PassingTypeEnum;
use App\Http\Enums\TimingEnum;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Attributes\Validation\BooleanType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Optional;

class TemplateTypeRequestDto extends CoreData
{
    public function __construct(
        #[Min(3)]
        #[Max(255)]
        public string $name,

        public null|string|Optional $description = null,

        #[Required]
        #[BooleanType]
        public bool $hasSystemQuestions,

        #[Min(0)]
        public null|int|Optional $maxSystemQuestionCount = null,

        #[Required]
        #[BooleanType]
        public bool $hasCustomQuestions,

        #[Min(0)]
        public null|int|Optional $maxCustomQuestionCount = null,

        #[Between(8001, 8003)]
        public int $passingTypeCode = PassingTypeEnum::ALL->value,

        #[Between(6000, 7000)]
        public int $timingCode = TimingEnum::ALL->value,

        #[Required]
        #[BooleanType]
        public bool $hasShuffling,

        #[Min(0)]
        public ?int $maxShuffledQuestionCount = null,

        #[Required]
        #[Between(1000, 2000)]
        public int $status = ActivationStatusEnum::ACTIVE->value,

        #[DataCollectionOf(QuestionCategoryRequestDto::class)]
        public DataCollection $questionCategories,
    ) {
    }

    public static function messages(): array
    {
        return [
            'name.min' => 'Ad ən azı 3 simvol olmalıdır',
            'name.max' => 'Ad maksimum 255 simvol ola bilər',
            'passingTypeCode.between' => 'passingTypeCode düzgün daxil edilməyib',
            'timingCode.between' => 'timingCode düzgün daxil edilməyib',
            'maxSystemQuestionCount.min' => 'maxSystemQuestionCount mənfi ola bilməz',
            'maxCustomQuestionCount.min' => 'maxCustomQuestionCount mənfi ola bilməz',
            'maxShuffledQuestionCount.min' => 'maxShuffledQuestionCount mənfi ola bilməz',
        ];
    }
}

