<?php

namespace App\Http\DTOs\Admin\Permission\Request;

use Spatie\LaravelData\Data;

class PermissionRequestDto extends Data
{
    public function __construct(
        public array $permissions,
    ) {
    }
}
