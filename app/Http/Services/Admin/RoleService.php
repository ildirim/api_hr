<?php

namespace App\Http\Services\Admin;

use App\Exceptions\BadRequestException;
use App\Http\DTOs\Admin\Role\Request\RoleRequestDto;
use App\Http\DTOs\Admin\Role\Response\RoleResponseDto;
use App\Http\Enums\ActivationStatusEnum;
use App\Http\Requests\Admin\RoleRequest;
use App\Interfaces\Admin\Role\RoleRepositoryInterface;
use App\Interfaces\Admin\Role\RoleServiceInterface;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\DataCollection;

class RoleService implements RoleServiceInterface
{
    public function __construct(protected RoleRepositoryInterface $roleRepository)
    {
    }

    public function roles(): DataCollection
    {
        return RoleResponseDto::collection($this->roleRepository->roles());
    }

    public function roleById(int $id): RoleResponseDto
    {
        return RoleResponseDto::from($this->roleRepository->roleById($id));
    }

    public function store(RoleRequestDto $dto): RoleResponseDto
    {
        DB::beginTransaction();
        try {
            $existRole = $this->roleRepository->roleByAdminIdAndName(auth()->user()->id, $dto->name);
            if ($existRole) {
                throw new BadRequestException('Rol adı unikal olmalıdır');
            }
            $role = $this->roleRepository->store($dto);
            $role->syncPermissions($dto->permissions);
            DB::commit();

            return RoleResponseDto::from($role);
        } catch (BadRequestException $e) {
            DB::rollback();
            throw new BadRequestException($e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function update(int $id, RoleRequestDto $dto): RoleResponseDto
    {
        DB::beginTransaction();
        try {
            $adminId = auth()->user()->id;
            $existRole = $this->roleRepository->roleByAdminIdAndName($adminId, $dto->name);
            if ($existRole && $id != $existRole->id) {
                throw new BadRequestException('Rol adı unikal olmalıdır');
            }
            $role = $this->roleRepository->update($id, $adminId, $dto->name);
            $role->syncPermissions($dto->permissions);
//            $user->syncRoles(['writer']);
            DB::commit();

            return RoleResponseDto::from($role);
        } catch (BadRequestException $e) {
            DB::rollback();
            throw new BadRequestException($e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function updateStatus(int $id): RoleResponseDto
    {
        $role = $this->roleRepository->roleById($id);
        $status = $role->status == ActivationStatusEnum::ACTIVE->value
            ? ActivationStatusEnum::DEACTIVE->value
            : ActivationStatusEnum::ACTIVE->value;
        return RoleResponseDto::from($this->roleRepository->updateStatus($role, $status));
    }

    public function destroy(int $id): RoleResponseDto
    {
        return RoleResponseDto::from($this->roleRepository->destroy($id));
    }
}
