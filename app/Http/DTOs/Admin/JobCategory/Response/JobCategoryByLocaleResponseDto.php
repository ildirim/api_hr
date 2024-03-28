<?php

namespace App\Http\DTOs\Admin\JobCategory\Response;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class JobCategoryByLocaleResponseDto extends Data
{
    public function __construct(
        public int $id,
        public int $language_id,
        public int $job_category_id,
        public string $name,
    ) {
    }
}
