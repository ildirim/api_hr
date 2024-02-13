<?php

namespace App\Interfaces\Admin\Role;

use App\Http\DTOs\Admin\Role\Request\RoleRequestDto;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

interface RoleRepositoryInterface
{
    public function roles(int $adminId): Collection;

    public function roleById(int $id, int $adminId): Role;

    public function store(RoleRequestDto $dto): Role;

    public function update(int $id, int $adminId, string $name): Role;

    public function destroy(int $id): Role;
}
