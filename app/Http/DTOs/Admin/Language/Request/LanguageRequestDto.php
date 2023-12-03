<?php

namespace App\Http\DTOs\Admin\Language\Request;

use App\Http\Requests\Admin\LanguageRequest;
use Spatie\LaravelData\Data;

class LanguageRequestDto extends Data
{
    public function __construct(
        public string $name,
    ) {
    }

    public static function fromRequest(LanguageRequest $request): static
    {
        return new self(
            $request->input('name'),
        );
    }
}
