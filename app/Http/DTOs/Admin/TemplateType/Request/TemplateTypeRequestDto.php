<?php

namespace App\Http\DTOs\Admin\TemplateType\Request;

use App\Http\DTOs\CoreData;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Optional;

class TemplateTypeRequestDto extends CoreData
{
    public function __construct(
        #[Min(3)]
        #[Max(255)]
        public string $name,
        public string|Optional $description,
        public bool $hasSystemQuestions,
        #[Min(0)]
        public int|Optional $maxSystemQuestionCount,
        #[Min(0)]
        public int|Optional $maxCustomQuestionCount,
        #[Between(8001, 8003)]
        public int $passingTypeCode,
        #[Between(6000, 7000)]
        public int|Optional $timingCode,
        public bool $hasShuffleQuestions,
        #[Min(0)]
        public int|Optional $maxShuffledQuestionCount,
        public int|Optional $status,
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

