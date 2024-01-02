<?php

namespace App\Http\DTOs\Admin\Role\Request;

use App\Http\Requests\Admin\RoleRequest;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class RoleRequestDto extends Data
{
    public function __construct(
        public int $adminId,
        public string $name,
        public array $permissions,
    ) {
    }

    public static function fromRequest(RoleRequest $request): static
    {
        return new self(
            auth('admin')->user()->id,
            $request->input('name'),
            $request->input('permissions')
        );
    }
}
