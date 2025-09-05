<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\Permission\PermissionServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    use BaseResponse;

    public function __construct(protected PermissionServiceInterface $permissionService)
    {
    }

    public function permissions(): JsonResponse
    {
        $permissions = $this->permissionService->groupedPermissions();
        return $this->success($permissions);
    }
}
