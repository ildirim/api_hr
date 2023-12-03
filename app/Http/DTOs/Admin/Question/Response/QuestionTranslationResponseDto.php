<?php


namespace App\Http\DTOs\Admin\Question\Response;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class QuestionTranslationResponseDto extends Data
{
    public function __construct(
        public int $id,
        public int $language_id,
        public string $content,
    )
    {
    }
}
