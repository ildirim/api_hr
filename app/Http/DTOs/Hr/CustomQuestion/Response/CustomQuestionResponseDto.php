<?php

namespace App\Http\DTOs\Hr\CustomQuestion\Response;

use App\Http\DTOs\Hr\CustomAnswer\Response\CustomAnswerResponseDto;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CustomQuestionResponseDto extends Data
{
    public function __construct(
        public ?int $id,
        public string $content,
        #[DataCollectionOf(CustomAnswerResponseDto::class)]
        public ?DataCollection $answers,
    ) {
    }
}
