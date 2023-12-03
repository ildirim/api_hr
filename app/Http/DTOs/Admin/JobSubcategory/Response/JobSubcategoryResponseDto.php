<?php

namespace App\Http\DTOs\Admin\JobSubcategory\Response;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class JobSubcategoryResponseDto extends Data
{
    public function __construct(
        public int $id,
        public int $job_category_id,
        #[DataCollectionOf(JobSubcategoryTranslationResponseDto::class)]
        public ?DataCollection $translations,
    ) {
    }
}
