<?php

namespace App\Http\DTOs\Admin\JobCategory\Request;

use App\Http\Requests\Admin\JobCategoryRequest;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class JobCategoryRequestDto extends Data
{
    public function __construct(
        #[DataCollectionOf(JobCategoryTranslationRequestDto::class)]
        public DataCollection $translations,
    ) {
    }

    public static function fromRequest(JobCategoryRequest $request): static
    {
        return new self(
            JobCategoryTranslationRequestDto::collection($request->input('translations')),
        );
    }
}
