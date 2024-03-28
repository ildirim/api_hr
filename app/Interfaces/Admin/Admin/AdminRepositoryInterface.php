<?php

namespace App\Interfaces\Admin\Admin;

use App\Http\DTOs\Admin\Admin\Request\AdminRequestDto;
use App\Models\Admin;
use Illuminate\Support\Collection;

interface AdminRepositoryInterface
{
    public function admins(): Collection;

    public function adminById(int $id): Admin;

    public function store(AdminRequestDto $dto): Admin;

    public function update(int $id, AdminRequestDto $dto): Admin;

    public function destroy(int $id): Admin;
}
