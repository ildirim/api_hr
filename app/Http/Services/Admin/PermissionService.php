<?php

namespace App\Http\Services\Admin;

use App\Http\DTOs\Admin\Permission\Response\PermissionGroupResponseDto;
use App\Http\DTOs\Admin\Permission\Response\PermissionResponseDto;
use App\Interfaces\Admin\Permission\PermissionRepositoryInterface;
use App\Interfaces\Admin\Permission\PermissionServiceInterface;
use Spatie\LaravelData\DataCollection;

class PermissionService implements PermissionServiceInterface
{
    public function __construct(protected PermissionRepositoryInterface $permissionRepository)
    {
    }

    public function permissions(): DataCollection
    {
        $groupedPermissions = $this->permissionRepository->permissions()->groupBy('group_name')->map(function ($permissions, $groupName) {
            $permissions = $permissions->map(function ($permission) {
                return [
                    'id' => $permission['id'],
                    'name' => $permission['name']
                ];
            })->values()->toArray();
            return [
                'groupName' => $groupName,
                'permissions' => $permissions
            ];
        })->values();
        return PermissionGroupResponseDto::collection($groupedPermissions);
    }
}
