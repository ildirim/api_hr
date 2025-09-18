<?php

namespace App\Http\DTOs\Admin\Question\Request;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class QuestionSelectRequestDto extends Data
{
    public function __construct(
        public ?int $jobSubcategory,
        public ?int $questionCategory,
        public ?int $questionLevel,
    ) {
    }
}
