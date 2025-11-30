<?php

namespace App\Http\DTOs\Admin\Package\Response;

use Spatie\LaravelData\Data;

class PackageTemplateTypeResponseDto extends Data
{
    public function __construct(
        public int $id,
        public string $name,
    ) {
    }
}
