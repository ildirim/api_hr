<?php

namespace App\Interfaces\Admin\Admin;

use App\Http\DTOs\Admin\Admin\Request\AdminRequestDto;
use App\Http\DTOs\Admin\Admin\Response\AdminResponseDto;
use Spatie\LaravelData\DataCollection;

interface AdminServiceInterface
{
    public function admins(): DataCollection;

    public function adminById(int $id): AdminResponseDto;

    public function store(AdminRequestDto $dto): AdminResponseDto;

    public function update(int $id, AdminRequestDto $request): AdminResponseDto;

    public function destroy(int $id): AdminResponseDto;
}
