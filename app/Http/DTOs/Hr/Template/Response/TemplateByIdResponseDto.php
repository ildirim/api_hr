<?php

namespace App\Http\DTOs\Hr\Template\Response;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class TemplateByIdResponseDto extends Data
{
    public function __construct(
        public ?int $id,
        public ?int $company_id,
        public ?int $job_subcategory_id,
        public ?int $language_id,
        public ?int $job_category_id,
        public ?string $name,
        public ?int $plan_code,
        public ?string $job_category_name,
        public ?string $job_subcategory_name,
        public ?string $language,
    ) {
    }
}
