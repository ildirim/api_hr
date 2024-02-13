<?php

namespace App\Http\DTOs\Admin\Permission\Response;

use Spatie\LaravelData\Data;

class PermissionResponseDto extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public ?bool $isActive,
    ) {
    }
}
