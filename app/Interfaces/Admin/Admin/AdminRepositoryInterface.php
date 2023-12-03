<?php

namespace App\Interfaces\Admin\Admin;

use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Http\Resources\Json\JsonResource;

interface AdminRepositoryInterface
{
    public function admins(): JsonResource;

    public function adminById(int $id): JsonResource;

    public function store(AdminRequest $request): JsonResource;

    public function update(int $id, AdminRequest $request): JsonResource;

    public function destroy(int $id): JsonResource;
}
