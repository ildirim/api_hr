<?php

namespace App\Interfaces\Admin\Package;

use App\Http\DTOs\Admin\Package\Request\PackageRequestDto;
use App\Models\Package;
use Illuminate\Support\Collection;

interface PackageRepositoryInterface
{
    public function packages(): Collection;

    public function packageById(int $id): ?Package;

    public function store(PackageRequestDto $request): Package;

    public function update(int $id, PackageRequestDto $request): Package;

    public function destroy(Package $package): bool;
}
