<?php

namespace App\Http\DTOs\Hr\Answer\Response;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class AnswerResponseDto extends Data
{
    public function __construct(
        public int $id,
        public int $is_correct,
        public string $name,
    ) {
    }
}
