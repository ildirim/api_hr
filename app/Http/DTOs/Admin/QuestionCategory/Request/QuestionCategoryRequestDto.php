<?php

namespace App\Http\DTOs\Admin\QuestionCategory\Request;

use App\Http\Requests\Admin\QuestionCategoryRequest;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class QuestionCategoryRequestDto extends Data
{
    public function __construct(
        #[DataCollectionOf(QuestionCategoryTranslationRequestDto::class)]
        public DataCollection $translations,
    ) {
    }

    public static function fromRequest(QuestionCategoryRequest $request): static
    {
        return new self(
            QuestionCategoryTranslationRequestDto::collection($request->input('translations')),
        );
    }
}
