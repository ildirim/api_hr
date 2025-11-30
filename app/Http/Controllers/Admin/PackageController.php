<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\Package\Request\PackageRequestDto;
use App\Interfaces\Admin\Package\PackageServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PackageController extends Controller
{
    use BaseResponse;

    public function __construct(protected PackageServiceInterface $packageService)
    {
    }

    public function packages(): JsonResponse
    {
        $packages = $this->packageService->packages();
        return $this->success($packages);
    }

    public function packageById(int $id): JsonResponse
    {
        $package = $this->packageService->packageById($id);
        return $this->success($package);
    }

    public function store(PackageRequestDto $request): JsonResponse
    {
        $this->packageService->store($request);
        return $this->success(null, 'Package created successfully', 'success', Response::HTTP_CREATED);
    }

    public function update(int $id, PackageRequestDto $request): JsonResponse
    {
        $this->packageService->update($id, $request);
        return $this->success(null, 'Package updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {
        $this->packageService->destroy($id);
        return $this->success(null, 'Package deleted successfully');
    }
}
