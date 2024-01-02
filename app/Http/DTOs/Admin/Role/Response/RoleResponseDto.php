<?php

namespace App\Http\DTOs\Admin\Role\Response;

use Spatie\LaravelData\Data;

class RoleResponseDto extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
    ) {
    }
}
