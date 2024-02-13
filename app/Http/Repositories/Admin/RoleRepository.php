<?php

namespace App\Http\Repositories\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\Role\Request\RoleRequestDto;
use App\Interfaces\Admin\Role\RoleRepositoryInterface;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function __construct(protected Role $role)
    {
    }

    public function roles(int $adminId): Collection
    {
        return $this->role->select('r.*', 'a.first_name', 'a.last_name')
            ->from('roles as r')
            ->leftJoin('admins as a', 'r.admin_id', 'a.id')
            ->where('r.admin_id', $adminId)
            ->orderBy('r.id', 'desc')
            ->get();
    }

    public function roleById(int $id, int $adminId): Role
    {
        $role = $this->role->with('permissions:id,name')
            ->where('admin_id', $adminId)
            ->where('id', $id)
            ->first();
        if (!$role) {
            throw new NotFoundException('Rol tapılmadı');
        }
        return $role;
    }

    public function roleByAdminIdAndName(int $adminId, string $name): ?Role
    {
        return $this->role->select('id')
            ->where('admin_id', $adminId)
            ->where('name', $name)
            ->first();
    }

    public function store(RoleRequestDto $dto): Role
    {
        return $this->role->create($dto->toArray());
    }

    public function update(int $id, int $adminId, string $name): Role
    {
        $role = $this->role->where('id', $id)
            ->where('admin_id', $adminId)
            ->first();
        if (!$role) {
            throw new NotFoundException('Rol tapılmadı');
        }

        $requestData = ['name' => $name];
        $role->update($requestData);
        return $role;
    }

    public function updateStatus(Role $role, int $status): Role
    {
        $requestData = ['status' => $status];
        $role->update($requestData);
        return $role;
    }

    public function destroy(int $id): Role
    {
        // delete if not assigned to anyone
        $role = $this->role->find($id);
        if (!$role) {
            throw new NotFoundException('Rol tapılmadı');
        }
        $role->delete();
        return $role;
    }
}
