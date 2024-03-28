<?php

namespace App\Http\DTOs\Hr\CustomQuestion\Request;

use App\Http\Requests\Hr\CustomQuestionRequest;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CustomQuestionRequestDto extends Data
{
    public function __construct(
        public int $adminId,
        public int $templateId,
        public int $languageId,
        public string $content,
    ) {
    }
}
