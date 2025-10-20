<?php

namespace App\Http\DTOs\Hr\Template\Request;

use App\Http\DTOs\CoreData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\DigitsBetween;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Optional;

class TemplateCategoryRequestDto extends CoreData
{
    public function __construct(
        #[DataCollectionOf(QuestionAndOrderRequestDto::class)]
        public DataCollection $questions,
        #[Exists('question_categories', 'id')]
        public null|int $questionCategoryId = null,
        #[DigitsBetween(1, 10000)]
        public int|Optional $duration = 0,
        public int|Optional $orderNumber = 0,
    ) {
    }

    public static function messages(): array
    {
        return [
            'questions.required' => 'Suallar daxil edilməyib',
            'duration.integer' => 'Müddət rəqəm tipi olmalıdır',
            'duration.digits_between' => 'Müddət maksimal 10000 ola bilər',
        ];
    }
}
