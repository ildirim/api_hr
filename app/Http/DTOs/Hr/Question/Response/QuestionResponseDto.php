<?php

namespace App\Http\DTOs\Hr\Question\Response;

use App\Http\DTOs\Hr\Answer\Response\AnswerResponseDto;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class QuestionResponseDto extends Data
{
    public function __construct(
        public int $id,
        public int $question_level,
        public string $period,
        public string $content,
        #[DataCollectionOf(AnswerResponseDto::class)]
        public ?DataCollection $answers,
    ) {
    }
}
