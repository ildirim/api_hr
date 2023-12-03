<?php


namespace App\Http\DTOs\Admin\JobCategory\Request;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class JobCategoryTranslationRequestDto extends Data
{
    public function __construct(
        public ?int $id,
        public int $languageId,
        public string $name,
    )
    {
    }
}
