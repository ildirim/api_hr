<?php

namespace App\Http\DTOs\Hr\CustomAnswer\Request;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CustomAnswerRequestDto extends Data
{
    public function __construct(
        public int $isCorrect,
        public string $name,
    ) {
    }
}
