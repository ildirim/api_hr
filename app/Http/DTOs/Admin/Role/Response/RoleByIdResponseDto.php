<?php

namespace App\Http\DTOs\Admin\Role\Response;

use App\Http\DTOs\Admin\Permission\Response\PermissionGroupResponseDto;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class RoleByIdResponseDto extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        #[DataCollectionOf(PermissionGroupResponseDto::class)]
        public DataCollection $groupedPermissions,
    ) {
    }
}
