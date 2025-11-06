<?php

namespace App\Http\DTOs\Hr\CustomAnswer\Response;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class CustomAnswerResponseDto extends Data
{
    public function __construct(
        public int $id,
        public int $is_correct,
        public string $answer_text,
    ) {
    }
}
