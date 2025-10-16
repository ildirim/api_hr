<?php

namespace App\Http\DTOs\Hr\Question\Request;

use App\Http\Enums\LanguageEnum;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ShuffledQuestionDto extends Data
{
    #[Computed]
    public null|int $companyId;

    #[Computed]
    public int $languageId;

    public function __construct(
        public null|int $questionsCount,
        #[Exists('templates', 'id')]
        public null|int $templateId,
    ) {
        $this->languageId = request()->get('Accept-Language') ?? LanguageEnum::ENGLISH->value;
    }
}
