<?php

namespace App\Http\Services\Admin;

use App\Http\Requests\Admin\RoleRequest;
use App\Http\Resources\Admin\RoleResource;
use App\Interfaces\Admin\Role\RoleRepositoryInterface;
use App\Interfaces\Admin\Role\RoleServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class RoleService implements RoleServiceInterface
{
    public function __construct(protected RoleRepositoryInterface $roleRepository)
    {
    }

    public function roles(): JsonResource
    {
        return $this->roleRepository->roles();
    }

    public function roleById(int $id): JsonResource
    {
        return $this->roleRepository->roleById($id);
    }

    public function store(RoleRequest $request): JsonResource
    {
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->store($request->name);
            $role->syncPermissions($request->permissions);
            DB::commit();

            return new RoleResource($role);
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function update(int $id, RoleRequest $request): JsonResource
    {
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->update($id, $request->name);
            $role->syncPermissions($request->permissions);
//            $user->syncRoles(['writer']);
            DB::commit();

            return new RoleResource($role);
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function destroy(int $id): JsonResource
    {
        return $this->roleRepository->destroy($id);
    }
}
