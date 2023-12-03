<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
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
        try {
            $admins = $this->adminService->admins();
            return $this->success(Response::HTTP_OK, $admins);
        } catch (\Exception $e) {
            return $this->error(Response::HTTP_BAD_REQUEST, ['error' => [$e->getMessage()]]);
        }
    }

    public function adminById(int $id): JsonResponse
    {
        try {
            $admin = $this->adminService->adminById($id);
            return $this->success(Response::HTTP_OK, $admin);
        } catch (\Exception $e) {
            return $this->error(Response::HTTP_BAD_REQUEST, ['error' => [$e->getMessage()]]);
        }
    }

    public function store(AdminRequest $request): JsonResponse
    {
        try {
            $admin = $this->adminService->store($request);
            return $this->success(Response::HTTP_CREATED, $admin);
        } catch (\Exception $e) {
            return $this->error(Response::HTTP_BAD_REQUEST, ['error' => [$e->getMessage()]]);
        }
    }

    public function update(int $id, AdminRequest $request): JsonResponse
    {
        try {
            $result = $this->adminService->update($id, $request);
            return $this->success(Response::HTTP_OK, $result);
        } catch (NotFoundException $e) {
            return $e->render();
        } catch (\Exception $e) {
            return $this->error(Response::HTTP_BAD_REQUEST, ['error' => [$e->getMessage()]]);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $result = $this->adminService->destroy($id);
            return $this->success(Response::HTTP_OK, $result);
        } catch (NotFoundException $e) {
            return $e->render();
        } catch (\Exception $e) {
            return $this->error(Response::HTTP_BAD_REQUEST, ['error' => [$e->getMessage()]]);
        }
    }
}
