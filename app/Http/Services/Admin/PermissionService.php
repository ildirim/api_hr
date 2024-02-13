<?php

namespace App\Http\Services\Admin;

use App\Http\DTOs\Admin\Permission\Response\PermissionGroupResponseDto;
use App\Http\DTOs\Admin\Permission\Response\PermissionResponseDto;
use App\Interfaces\Admin\Permission\PermissionRepositoryInterface;
use App\Interfaces\Admin\Permission\PermissionServiceInterface;
use App\Helpers\PermissionHelper;
use Spatie\LaravelData\DataCollection;

class PermissionService implements PermissionServiceInterface
{
    public function __construct(protected PermissionRepositoryInterface $permissionRepository)
    {
    }

    public function permissions(): DataCollection
    {
        return PermissionResponseDto::collection($this->permissionRepository->permissions());
    }

    public function groupedPermissions(): DataCollection
    {
        $permissions = $this->permissionRepository->permissions();
        $groupedPermissions = PermissionHelper::groupPermissionsByRoleName($permissions);
        return PermissionGroupResponseDto::collection($groupedPermissions);
    }
}
