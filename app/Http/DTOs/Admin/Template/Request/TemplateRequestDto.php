<?php

namespace App\Http\DTOs\Admin\Template\Request;

use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

#[MapName(SnakeCaseMapper::class)]
class TemplateRequestDto extends Data
{
    #[Computed]
    public int $adminId;

    #[Computed]
    public ?int $companyId = null;

    public function __construct(
        public int $jobSubcategoryId,
        public int $languageId,
        public int $planCode,
        public string $name,
        public int|Optional $timingCode,
        public int|Optional $duration,
    ) {
        $admin = auth('admin')->user();
        $this->adminId = $admin->id;
        $this->companyId = $admin->company_id ?? null;
    }
}
