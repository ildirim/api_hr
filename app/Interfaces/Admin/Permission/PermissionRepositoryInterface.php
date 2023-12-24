<?php

namespace App\Interfaces\Admin\Permission;

use Spatie\Permission\Models\Permission;

interface PermissionRepositoryInterface
{
    public function permissions(): Permission;
}
