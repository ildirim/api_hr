<?php

namespace App\Http\DTOs\Admin\Template\Request;

use App\Http\Requests\Admin\TemplateRequest;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

#[MapName(SnakeCaseMapper::class)]
class TemplateRequestDto extends Data
{
    public function __construct(
        public int $jobSubcategoryId,
        public int $languageId,
        public int $planCode,
        public string $name,
        public int|Optional $companyId,
        public int|Optional $timingCode,
        public int|Optional $duration,
    ) {
    }

public
static function fromRequest(TemplateRequest $request): static
{
    return new self(
        $request->input('jobSubcategoryId'),
        $request->input('languageId'),
        $request->input('planCode'),
        $request->input('name'),
        Optional::create(),
        Optional::create(),
        Optional::create(),
    );
}
}
