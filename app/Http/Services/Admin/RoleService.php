<?php

namespace App\Http\Services\Admin;

use App\Exceptions\BadRequestException;
use App\Http\DTOs\Admin\Role\Request\RoleRequestDto;
use App\Http\DTOs\Admin\Role\Response\RoleResponseDto;
use App\Http\DTOs\Admin\Role\Response\RoleByIdResponseDto;
use App\Http\Enums\ActivationStatusEnum;
use App\Interfaces\Admin\Permission\PermissionRepositoryInterface;
use App\Interfaces\Admin\Role\RoleRepositoryInterface;
use App\Interfaces\Admin\Role\RoleServiceInterface;
use App\Helpers\PermissionHelper;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\DataCollection;

class RoleService implements RoleServiceInterface
{
    public function __construct(
        protected RoleRepositoryInterface $roleRepository,
        protected PermissionRepositoryInterface $permissionRepository,
    )
    {
    }

    public function roles(): DataCollection
    {
        $adminId = auth()->user()->id;
        return RoleResponseDto::collection($this->roleRepository->roles($adminId));
    }

    public function roleById(int $id): RoleByIdResponseDto
    {
        $adminId = auth()->user()->id;
        $role = $this->roleRepository->roleById($id, $adminId);
        $permissions = $this->permissionRepository->permissions();
        $rolePermissionIds = $role->permissions->pluck('id')->toArray();
        $permissions->map(function ($permission) use ($rolePermissionIds) {
            $permission->isActive = in_array($permission->id, $rolePermissionIds);
            return $permission;
        });
        $groupedPermissions = PermissionHelper::groupPermissionsByRoleName($permissions);
        $role->groupedPermissions = $groupedPermissions;
        return RoleByIdResponseDto::from($role);
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
        $role = $this->roleRepository->roleById($id, auth('admin')->user()->id);
        $status = $role->status == ActivationStatusEnum::ACTIVE->value
            ? ActivationStatusEnum::INACTIVE->value
            : ActivationStatusEnum::ACTIVE->value;
        return RoleResponseDto::from($this->roleRepository->updateStatus($role, $status));
    }

    public function destroy(int $id): RoleResponseDto
    {
        $role = $this->roleRepository->destroy($id);
        if ($role->users()->count() > 0) {
            throw new BadRequestException('Rol istifadəçiyə təyin edildiyi üçün silinə bilməz');
        }
        return RoleResponseDto::from($this->roleRepository->destroy($id));
    }
}
