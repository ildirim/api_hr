<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\Permission\PermissionServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    public function __construct(protected PermissionServiceInterface $roleService)
    {
    }

    public function permissions(): JsonResponse
    {
        $permissions = $this->roleService->permissions();
        return $this->success(Response::HTTP_OK, $permissions);
    }
}
