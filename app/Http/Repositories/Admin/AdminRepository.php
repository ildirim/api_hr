<?php

namespace App\Http\Repositories\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\Admin\Request\AdminRequestDto;
use App\Http\Resources\Admin\AdminResource;
use App\Interfaces\Admin\Admin\AdminRepositoryInterface;
use App\Models\Admin;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class AdminRepository implements AdminRepositoryInterface
{
    public function __construct(protected Admin $admin)
    {
    }

    public function admins(): Collection
    {
        return $this->admin->with(['roles' => function ($query) {
                $query->select('id', 'name');
            }])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function adminById(int $id): Admin
    {
        $admin = $this->admin->find($id);
        if (!$admin) {
            throw new NotFoundException('İstifadəçi tapılmadı');
        }
        return $admin;
    }

    public function store(AdminRequestDto $dto): Admin
    {
        return $this->admin->create($dto->toArray());
    }

    public function update(int $id, AdminRequestDto $dto): Admin
    {
        $admin = $this->admin->find($id);
        if (!$admin) {
            throw new NotFoundException('İstifadəçi tapılmadı');
        }

        $requestData = $dto->toArray();
        if ($dto->password) {
            $requestData['password'] = bcrypt($dto->password);
        }
        $admin->update($requestData);

        return $admin;
    }

    public function destroy(int $id): Admin
    {
        $admin = $this->admin->find($id);
        if (!$admin) {
            throw new NotFoundException('İstifadəçi tapılmadı');
        }
        $admin->delete();

        return $admin;
    }
}
