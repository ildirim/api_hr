<?php

namespace App\Http\DTOs\Admin\Role\Response;

use Spatie\LaravelData\Data;
use Spatie\Permission\Models\Role;

class RoleResponseDto extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $created_by,
        public string $created_at,
    ) {
    }

    public static function fromModel(Role $role): self
    {
        return new self(
            $role->id,
            $role->name,
            "{$role->first_name} {$role->last_name}",
            $role->created_at
        );
    }
}
