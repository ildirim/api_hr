<?php

namespace App\Http\Repositories\Admin;

use App\Http\DTOs\Admin\Package\Request\PackageRequestDto;
use App\Interfaces\Admin\Package\PackageRepositoryInterface;
use App\Models\Package;
use Illuminate\Support\Collection;

class PackageRepository implements PackageRepositoryInterface
{
    public function __construct(protected Package $package)
    {
    }

    public function packages(): Collection
    {
        return $this->package
            ->with(['templateTypes:id,name'])
            ->get();
    }

    public function packageById(int $id): ?Package
    {
        return $this->package
            ->with(['templateTypes:id,name'])
            ->find($id);
    }

    public function store(PackageRequestDto $request): Package
    {
        $data = PackageRequestDto::toLower($request->except('templateTypes')->toArray());
        return $this->package->create($data);
    }

    public function update(int $id, PackageRequestDto $request): Package
    {
        $data = PackageRequestDto::toLower($request->except('templateTypes')->toArray());
        $package = $this->package->findOrFail($id);
        $package->update($data);
        return $package;
    }

    public function destroy(Package $package): bool
    {
        return $package->delete();
    }
}
