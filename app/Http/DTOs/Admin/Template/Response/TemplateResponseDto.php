<?php

namespace App\Http\DTOs\Admin\Template\Response;

use Spatie\LaravelData\Data;

class TemplateResponseDto extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
    ) {
    }
}
