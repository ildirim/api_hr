<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\Admin\Request\AdminRequestDto;
use App\Http\Requests\Admin\AdminRequest;
use App\Interfaces\Admin\Admin\AdminServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    public function __construct(protected AdminServiceInterface $adminService)
    {
    }

    public function admins(): JsonResponse
    {
        $admins = $this->adminService->admins();
        return $this->success(Response::HTTP_OK, $admins);

    }

    public function adminById(int $id): JsonResponse
    {
        $admin = $this->adminService->adminById($id);
        return $this->success(Response::HTTP_OK, $admin);

    }

    public function store(AdminRequest $request): JsonResponse
    {
        $adminRequestDto = AdminRequestDto::fromRequest($request);
        $admin = $this->adminService->store($adminRequestDto);
        return $this->success(Response::HTTP_CREATED, $admin);

    }

    public function update(int $id, AdminRequest $request): JsonResponse
    {
        $result = $this->adminService->update($id, $request);
        return $this->success(Response::HTTP_OK, $result);
    }

    public function destroy($id): JsonResponse
    {
        $result = $this->adminService->destroy($id);
        return $this->success(Response::HTTP_OK, $result);
    }
}
