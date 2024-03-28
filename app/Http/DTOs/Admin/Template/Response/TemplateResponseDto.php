<?php

namespace App\Http\DTOs\Admin\Template\Response;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class TemplateResponseDto extends Data
{
    public function __construct(
        public ?int $id,
        public ?string $name,
        public ?string $duration,
        public ?int $plan_code,
        public ?int $timing_code,
        public ?string $job_category_name,
        public ?string $job_subcategory_name,
        public ?string $language,
        public ?string $created_at,
    ) {
    }
}
