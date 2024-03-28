<?php

namespace App\Http\DTOs\Admin\JobSubcategory\Response;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class JobSubcategoryByLocaleResponseDto extends Data
{
    public function __construct(
        public int $id,
        public int $language_id,
        public int $job_subcategory_id,
        public string $name,
    ) {
    }
}
