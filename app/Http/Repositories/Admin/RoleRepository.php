<?php

namespace App\Http\Repositories\Admin;

use App\Exceptions\NotFoundException;
use App\Http\Resources\Admin\RoleResource;
use App\Interfaces\Admin\Role\RoleRepositoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function __construct(protected Role $role)
    {
    }

    public function roles(): JsonResource
    {
        return RoleResource::collection($this->role->with('permissions:id,name')->get());
    }

    public function roleById(int $id): JsonResource
    {
        $role = $this->role->with('permissions:id,name')->find($id);
        if (!$role) {
            throw new NotFoundException('Rol tapılmadı');
        }
        return new RoleResource($role);
    }

    public function store(string $name): JsonResource
    {
        $requestData = [
            'name' => $name
        ];

        return new RoleResource($this->role->create($requestData));
    }

    public function update(int $id, string $name): JsonResource
    {
        $role = $this->role->find($id);
        if (!$role) {
            throw new NotFoundException('Rol tapılmadı');
        }

        $requestData = ['name' => $name];
        $role->update($requestData);

        return new RoleResource($role);
    }

    public function destroy(int $id): JsonResource
    {
        $role = $this->role->find($id);
        if (!$role) {
            throw new NotFoundException('Rol tapılmadı');
        }
        $role->delete();

        return new RoleResource($role);
    }
}
