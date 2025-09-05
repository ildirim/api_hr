<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\Role\Request\RoleRequestDto;
use App\Http\Requests\Admin\RoleRequest;
use App\Interfaces\Admin\Role\RoleServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    use BaseResponse;

    public function __construct(protected RoleServiceInterface $roleService)
    {
    }

    public function roles(): JsonResponse
    {
        $roles = $this->roleService->roles();
        return $this->success($roles);
    }

    public function roleById(int $id): JsonResponse
    {
        $role = $this->roleService->roleById($id);
        return $this->success($role);
    }

    public function store(RoleRequest $request): JsonResponse
    {
        $roleRequestDto = RoleRequestDto::fromRequest($request);
        $role = $this->roleService->store($roleRequestDto);
        return $this->success($role, 'Role created successfully', 'success', Response::HTTP_CREATED);
    }

    public function update(int $id, RoleRequest $request): JsonResponse
    {
        $roleRequestDto = RoleRequestDto::fromRequest($request);
        $result = $this->roleService->update($id, $roleRequestDto);
        return $this->success($result);
    }

    public function updateStatus(int $id): JsonResponse
    {
        $result = $this->roleService->updateStatus($id);
        return $this->success($result);
    }

    public function destroy($id): JsonResponse
    {
        $result = $this->roleService->destroy($id);
        return $this->success($result);
    }
}
