<?php

namespace App\Interfaces\Admin\Package;

use App\Http\DTOs\Admin\Package\Request\PackageRequestDto;
use App\Http\DTOs\Admin\Package\Response\PackageResponseDto;
use Spatie\LaravelData\DataCollection;

interface PackageServiceInterface
{
    public function packages(): DataCollection;

    public function packageById(int $id): ?PackageResponseDto;

    public function store(PackageRequestDto $request): void;

    public function update(int $id, PackageRequestDto $request): void;

    public function destroy(int $id): void;
}
