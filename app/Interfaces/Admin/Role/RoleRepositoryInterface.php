<?php

namespace App\Interfaces\Admin\Role;

use Illuminate\Http\Resources\Json\JsonResource;

interface RoleRepositoryInterface
{
    public function roles(): JsonResource;

    public function roleById(int $id): JsonResource;

    public function store(string $name): JsonResource;

    public function update(int $id, string $name): JsonResource;

    public function destroy(int $id): JsonResource;
}
