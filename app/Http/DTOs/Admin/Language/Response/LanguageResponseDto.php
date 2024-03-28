<?php

namespace App\Http\DTOs\Admin\Language\Response;

use Spatie\LaravelData\Data;

class LanguageResponseDto extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $locale,
    ) {
    }
}
