<?php

namespace App\Interfaces\Admin\Permission;

use Spatie\LaravelData\DataCollection;

interface PermissionServiceInterface
{
    public function permissions(): DataCollection;
}
