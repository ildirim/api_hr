<?php

namespace App\Http\DTOs\Admin\TemplateType\Request;

use App\Http\DTOs\CoreData;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Optional;

class QuestionCategoryRequestDto extends CoreData
{
    public function __construct(
        public ?int $id,

        public int $questionCategoryId,

        #[Min(0)]
        public null|int|Optional $maxQuestionCount = null,
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

