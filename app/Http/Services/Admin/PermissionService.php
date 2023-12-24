<?php

namespace App\Http\Services\Admin;

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
        return PermissionResponseDto::collection($this->permissionRepository->permissions());
    }
}
