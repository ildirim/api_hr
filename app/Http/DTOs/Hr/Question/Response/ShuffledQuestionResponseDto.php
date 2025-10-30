<?php

namespace App\Http\DTOs\Hr\Question\Response;

use App\Http\DTOs\Hr\Answer\Response\AnswerResponseDto;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class ShuffledQuestionResponseDto extends Data
{
    public function __construct(
        public int $id,
        public int $questionLevel,
        public string $period,
        public ?string $content,
        #[DataCollectionOf(AnswerResponseDto::class)]
        public ?DataCollection $answers,
    ) {
    }
}

