<?php

namespace App\Http\DTOs\Admin\TemplateType\Response;

use Spatie\LaravelData\Data;

class TemplateTypeResponseDto extends Data
{
    public function __construct(
        public int $id,
        public string $name,
    ) {
    }
}
