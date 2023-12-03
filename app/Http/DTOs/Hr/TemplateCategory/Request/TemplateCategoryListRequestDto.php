<?php

namespace App\Http\DTOs\Hr\TemplateCategory\Request;

use App\Http\Requests\Hr\TemplateCategoryRequest;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class TemplateCategoryListRequestDto extends Data
{
    public function __construct(
        #[DataCollectionOf(TemplateCategoryRequestDto::class)]
        public DataCollection $templateCategories,
    ) {
    }

    public static function fromRequest(TemplateCategoryRequest $request): static
    {
        return new self(
            TemplateCategoryAndQuestionsRequestDto::collection($request->input('templateCategories')),
        );
    }
}
