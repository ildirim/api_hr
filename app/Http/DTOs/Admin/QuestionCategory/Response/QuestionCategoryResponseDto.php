<?php

namespace App\Http\DTOs\Admin\QuestionCategory\Response;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class QuestionCategoryResponseDto extends Data
{
    public function __construct(
        public int $id,
        #[DataCollectionOf(QuestionCategoryTranslationResponseDto::class)]
        public ?DataCollection $translations,
    ) {
    }
}
