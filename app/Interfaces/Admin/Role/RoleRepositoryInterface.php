<?php

namespace App\Interfaces\Admin\Role;

use App\Http\DTOs\Admin\Role\Request\RoleRequestDto;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

interface RoleRepositoryInterface
{
    public function roles(): Collection;

    public function roleById(int $id): Role;

    public function store(RoleRequestDto $dto): Role;

    public function update(int $id, int $adminId, string $name): Role;

    public function destroy(int $id): Role;
}
