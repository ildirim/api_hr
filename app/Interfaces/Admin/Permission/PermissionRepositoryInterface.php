<?php

namespace App\Interfaces\Admin\Permission;

use Illuminate\Support\Collection;

interface PermissionRepositoryInterface
{
    public function permissions(): Collection;
}
