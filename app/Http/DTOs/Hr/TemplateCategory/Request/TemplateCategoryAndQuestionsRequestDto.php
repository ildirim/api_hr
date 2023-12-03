<?php

namespace App\Http\DTOs\Hr\TemplateCategory\Request;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class TemplateCategoryAndQuestionsRequestDto extends Data
{
    public function __construct(
        public int $templateId,
        public int $questionCategoryId,
        public int $duration,
        public bool $isGrouped,
        public array $questions,
        public array $customQuestions,
    ) {
    }
}
