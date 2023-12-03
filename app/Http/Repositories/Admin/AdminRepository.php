<?php

namespace App\Http\Repositories\Admin;

use App\Exceptions\NotFoundException;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Interfaces\Admin\Admin\AdminRepositoryInterface;
use App\Models\Admin;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminRepository implements AdminRepositoryInterface
{
    public function __construct(protected Admin $admin)
    {
    }

    public function admins(): JsonResource
    {
        return AdminResource::collection($this->admin->with('roles')->get());
    }

    public function adminById(int $id): JsonResource
    {
        $admin = $this->admin->find($id);
        if (!$admin) {
            throw new NotFoundException('İstifadəçi tapılmadı');
        }
        return new AdminResource($admin);
    }

    public function store(AdminRequest $request): JsonResource
    {
        $requestData = $request->validated();
        $requestData['password'] = bcrypt($requestData['password']);
        return new AdminResource($this->admin->create($requestData));
    }

    public function update(int $id, AdminRequest $request): JsonResource
    {
        $admin = $this->admin->find($id);
        if (!$admin) {
            throw new NotFoundException('İstifadəçi tapılmadı');
        }

        $requestData = $request->validated();
        if($request->password) {
            $requestData['password'] = bcrypt($request->password);
        }
        $admin->update($requestData);

        return new AdminResource($admin);
    }

    public function destroy(int $id): JsonResource
    {
        $admin = $this->admin->find($id);
        if (!$admin) {
            throw new NotFoundException('İstifadəçi tapılmadı');
        }
        $admin->delete();

        return new AdminResource($admin);
    }
}
