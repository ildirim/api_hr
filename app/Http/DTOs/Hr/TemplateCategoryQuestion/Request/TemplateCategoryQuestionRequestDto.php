<?php

namespace App\Http\DTOs\Hr\TemplateCategoryQuestion\Request;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

#[MapName(SnakeCaseMapper::class)]
class TemplateCategoryQuestionRequestDto extends Data
{
    public function __construct(
        public int $companyId,
        public ?int $questionId,
        public ?int $customQuestionId,
    ) {
    }
}
