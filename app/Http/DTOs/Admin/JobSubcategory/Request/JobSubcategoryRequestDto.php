<?php

namespace App\Http\DTOs\Admin\JobSubcategory\Request;

use App\Http\Requests\Admin\JobSubcategoryRequest;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class JobSubcategoryRequestDto extends Data
{
    public function __construct(
        public int $jobCategoryId,
        #[DataCollectionOf(JobSubcategoryTranslationRequestDto::class)]
        public DataCollection $translations,
    ) {
    }

    public static function fromRequest(JobSubcategoryRequest $request): static
    {
        return new self(
            $request->input('jobCategoryId'),
            JobSubcategoryTranslationRequestDto::collection($request->input('translations')),
        );
    }
}
