<?php

namespace App\Http\DTOs\Admin\Template\Request;

use App\Http\Requests\Admin\TemplateRequest;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class TemplateRequestRepositoryDto extends Data
{
    public function __construct(
        public int $jobSubcategoryId,
        public int $adminId,
        public int $companyId,
        public int $languageId,
        public int $planCode,
        public string $name,
    ) {
    }
}
