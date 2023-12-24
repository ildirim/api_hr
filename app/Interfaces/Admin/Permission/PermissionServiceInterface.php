<?php

namespace App\Interfaces\Admin\Permission;

use Illuminate\Http\Resources\Json\JsonResource;

interface PermissionServiceInterface
{
    public function permissions(): JsonResource;
}
