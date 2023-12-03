<?php

namespace App\Http\Services\Admin;

use App\Http\Requests\Admin\AdminRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Interfaces\Admin\Admin\AdminRepositoryInterface;
use App\Interfaces\Admin\Admin\AdminServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class AdminService implements AdminServiceInterface
{
    public function __construct(protected AdminRepositoryInterface $adminRepository)
    {
    }

    public function admins(): JsonResource
    {
        return $this->adminRepository->admins();
    }

    public function adminById(int $id): JsonResource
    {
        return $this->adminRepository->adminById($id);
    }

    public function store(AdminRequest $request): JsonResource
    {
        DB::beginTransaction();
        try {
            $user = $this->adminRepository->store($request);
            $user->assignRole($request->roles);
            DB::commit();

            return new AdminResource($user);
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function update(int $id, AdminRequest $request): JsonResource
    {
        DB::beginTransaction();
        try {
            $user = $this->adminRepository->update($id, $request);
            $user->syncRoles($request->roles);
            DB::commit();

            return new AdminResource($user);
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function destroy(int $id): JsonResource
    {
        return $this->adminRepository->destroy($id);
    }
}
