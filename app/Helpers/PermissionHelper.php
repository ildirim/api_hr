<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class PermissionHelper
{
    public static function groupPermissionsByRoleName(Collection $permissions)
    {
        return $permissions->groupBy('group_name')->map(function ($permissions, $groupName) {
            $permissions = $permissions->map(function ($permission) {
                return [
                    'id' => $permission['id'],
                    'name' => $permission['name'],
                    'isActive' => $permission['isActive'] ?? null
                ];
            })->values()->toArray();
            return [
                'groupName' => $groupName,
                'permissions' => $permissions
            ];
        })->values();
    }
}
