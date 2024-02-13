<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\Permission\PermissionServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    public function __construct(protected PermissionServiceInterface $permissionService)
    {
    }

    public function permissions(): JsonResponse
    {
        $permissions = $this->permissionService->groupedPermissions();
        return $this->success(Response::HTTP_OK, $permissions);
    }
}
