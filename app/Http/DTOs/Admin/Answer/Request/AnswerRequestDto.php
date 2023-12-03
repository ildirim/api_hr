<?php

namespace App\Http\DTOs\Admin\Answer\Request;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AnswerRequestDto extends Data
{
    public function __construct(
        public int $isCorrect,
        #[DataCollectionOf(AnswerTranslationRequestDto::class)]
        public DataCollection $translations,
    ) {
    }
}
