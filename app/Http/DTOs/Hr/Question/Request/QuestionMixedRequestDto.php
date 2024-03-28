<?php

namespace App\Http\DTOs\Hr\Question\Request;

use App\Http\Requests\Hr\QuestionMixedRequest;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class QuestionMixedRequestDto extends Data
{
    public function __construct(
        public int $jobSubcategoryId,
        public int $languageId,
        public int $companyId,
    ) {
    }

    public static function fromRequest(QuestionMixedRequest $request): static
    {
        return new self(
            $request->input('jobSubcategoryId'),
            $request->input('languageId'),
            $request->input('companyId'),
        );
    }
}
