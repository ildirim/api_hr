<?php

namespace App\Http\Repositories\Admin;

use App\Interfaces\Admin\Permission\PermissionRepositoryInterface;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Collection;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function __construct(protected Permission $permission)
    {
    }

    public function permissions(): Collection
    {
        return $this->permission->orderBy('name', 'asc')
                ->get();
    }
}
