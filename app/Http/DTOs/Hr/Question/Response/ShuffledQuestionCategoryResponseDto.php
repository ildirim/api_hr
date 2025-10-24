<?php

namespace App\Http\DTOs\Hr\Question\Response;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class ShuffledQuestionCategoryResponseDto extends Data
{
    public function __construct(
        public int $questionCategoryId,
        #[DataCollectionOf(ShuffledQuestionResponseDto::class)]
        public DataCollection $questions,
    ) {
    }
}
