<?php


namespace App\Http\DTOs\Admin\JobSubcategory\Request;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class JobSubcategoryTranslationRequestDto extends Data
{
    public function __construct(
        public ?int $id,
        public int $languageId,
        public string $name,
    )
    {
    }
}
