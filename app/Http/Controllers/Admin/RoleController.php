<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Interfaces\Admin\Role\RoleServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function __construct(protected RoleServiceInterface $roleService)
    {
    }

    public function roles(): JsonResponse
    {
        $roles = $this->roleService->roles();
        return $this->success(Response::HTTP_OK, $roles);
    }

    public function roleById(int $id): JsonResponse
    {
        $role = $this->roleService->roleById($id);
        return $this->success(Response::HTTP_CREATED, $role);
    }

    public function store(RoleRequest $request): JsonResponse
    {
        $role = $this->roleService->store($request);
        return $this->success(Response::HTTP_OK, $role);
    }

    public function update(int $id, RoleRequest $request): JsonResponse
    {
        $result = $this->roleService->update($id, $request);
        return $this->success(Response::HTTP_OK, $result);
    }

    public function destroy($id): JsonResponse
    {
        $result = $this->roleService->destroy($id);
        return $this->success(Response::HTTP_OK, $result);
    }
}
