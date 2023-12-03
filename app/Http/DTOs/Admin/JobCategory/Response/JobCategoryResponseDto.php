<?php

namespace App\Http\DTOs\Admin\JobCategory\Response;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class JobCategoryResponseDto extends Data
{
    public function __construct(
        public int $id,
        #[DataCollectionOf(JobCategoryTranslationResponseDto::class)]
        public ?DataCollection $translations,
    ) {
    }
}
