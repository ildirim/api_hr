<?php

namespace App\Http\Services\Admin;

use App\Http\DTOs\Admin\Admin\Request\AdminRequestDto;
use App\Http\DTOs\Admin\Admin\Response\AdminResponseDto;
use App\Interfaces\Admin\Admin\AdminRepositoryInterface;
use App\Interfaces\Admin\Admin\AdminServiceInterface;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\DataCollection;

class AdminService implements AdminServiceInterface
{
    public function __construct(protected AdminRepositoryInterface $adminRepository)
    {
    }

    public function admins(): DataCollection
    {
        return AdminResponseDto::collection($this->adminRepository->admins());
    }

    public function adminById(int $id): AdminResponseDto
    {
        return AdminResponseDto::from($this->adminRepository->adminById($id));
    }

    public function store(AdminRequestDto $dto): AdminResponseDto
    {
        DB::beginTransaction();
        try {
            $user = $this->adminRepository->store($dto);
            $user->assignRole($dto->roles);
            DB::commit();

            return AdminResponseDto::from($user);
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function update(int $id, AdminRequestDto $dto): AdminResponseDto
    {
        DB::beginTransaction();
        try {
            $user = $this->adminRepository->update($id, $dto);
            $user->syncRoles($dto->roles);
            DB::commit();

            return AdminResponseDto::from($user);
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function destroy(int $id): AdminResponseDto
    {
        return AdminResponseDto::from($this->adminRepository->destroy($id));
    }
}
