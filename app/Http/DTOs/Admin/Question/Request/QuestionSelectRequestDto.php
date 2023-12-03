<?php

namespace App\Http\DTOs\Admin\Question\Request;

use App\Http\Requests\Admin\Question\QuestionSelectRequest;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

class QuestionSelectRequestDto extends Data
{
    public function __construct(
        public ?int $jobSubcategory,
        public ?int $questionCategory,
        public ?int $questionLevel,
    ) {
    }

    public static function fromRequest(QuestionSelectRequest $request): static
    {
        return new self(
            $request->input('jobSubcategory'),
            $request->input('questionCategory'),
            $request->input('questionLevel')
        );
    }
}
