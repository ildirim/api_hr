<?php

namespace App\Http\DTOs\Admin\Permission\Response;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class PermissionGroupResponseDto extends Data
{
    public function __construct(
        public string $groupName,
        #[DataCollectionOf(PermissionResponseDto::class)]
        public DataCollection $permissions,
    ) {
    }
}
