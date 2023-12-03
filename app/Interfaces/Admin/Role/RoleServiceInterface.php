<?php

namespace App\Interfaces\Admin\Role;

use App\Http\Requests\Admin\RoleRequest;
use Illuminate\Http\Resources\Json\JsonResource;

interface RoleServiceInterface
{
    public function roles(): JsonResource;

    public function roleById(int $id): JsonResource;

    public function store(RoleRequest $request): JsonResource;

    public function update(int $id, RoleRequest $request): JsonResource;

    public function destroy(int $id): JsonResource;
}
