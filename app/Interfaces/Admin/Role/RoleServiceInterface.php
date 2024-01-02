<?php

namespace App\Interfaces\Admin\Role;

use App\Http\DTOs\Admin\Role\Request\RoleRequestDto;
use App\Http\DTOs\Admin\Role\Response\RoleResponseDto;
use Spatie\LaravelData\DataCollection;

interface RoleServiceInterface
{
    public function roles(): DataCollection;

    public function roleById(int $id): RoleResponseDto;

    public function store(RoleRequestDto $dto): RoleResponseDto;

    public function update(int $id, RoleRequestDto $dto): RoleResponseDto;

    public function destroy(int $id): RoleResponseDto;
}
