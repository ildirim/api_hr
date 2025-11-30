<?php

namespace App\Http\Services\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\Package\Request\PackageRequestDto;
use App\Http\DTOs\Admin\Package\Request\PackageTemplateTypeDto;
use App\Http\DTOs\Admin\Package\Response\PackageResponseDto;
use App\Interfaces\Admin\Package\PackageRepositoryInterface;
use App\Interfaces\Admin\Package\PackageServiceInterface;
use Spatie\LaravelData\DataCollection;

class PackageService implements PackageServiceInterface
{
    public function __construct(
        protected PackageRepositoryInterface $packageRepository,
    ) {
    }

    public function packages(): DataCollection
    {
        $packages = $this->packageRepository->packages();

        return PackageResponseDto::collection($packages);
    }

    public function packageById(int $id): ?PackageResponseDto
    {
        $package = $this->packageRepository->packageById($id);

        if (!$package) {
            return null;
        }

        return PackageResponseDto::from($package);
    }

    public function store(PackageRequestDto $request): void
    {
        $package = $this->packageRepository->store($request);

        $this->syncTemplateTypes($package, $request->templateTypes);
    }

    public function update(int $id, PackageRequestDto $request): void
    {
        $package = $this->packageRepository->update($id, $request);

        // Sync template types with pivot data
        $this->syncTemplateTypes($package, $request->templateTypes);
    }

    public function destroy(int $id): void
    {
        $package = $this->packageRepository->packageById($id);

        if (!$package) {
            throw new NotFoundException('Package not found');
        }

        $this->packageRepository->destroy($package);
    }

    protected function syncTemplateTypes($package, DataCollection $templateTypes): void
    {
        $syncData = [];

        foreach ($templateTypes as $templateType) {
            /** @var PackageTemplateTypeDto $templateType */
            $syncData[$templateType->templateTypeId] = [
                'count' => $templateType->count,
                'order' => $templateType->order,
            ];
        }

        $package->templateTypes()->sync($syncData);
    }
}
