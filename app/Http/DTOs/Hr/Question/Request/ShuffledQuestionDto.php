<?php

namespace App\Http\DTOs\Hr\Question\Request;

use App\Http\Enums\LanguageEnum;
use App\Http\Enums\TemplateTypeEnum;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ShuffledQuestionDto extends Data
{
    #[Computed]
    public int $companyId;

    #[Computed]
    public int $languageId;

    public function __construct(
        public int $jobSubcategoryId,
        #[Enum(TemplateTypeEnum::class)]
        public int $type,
    ) {
        $this->languageId = request()->get('lang') ?? LanguageEnum::ENGLISH->value;
    }
}
