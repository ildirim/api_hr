<?php

namespace App\Interfaces\Hr\Package;

use App\Http\DTOs\Admin\Package\Request\PurchasePackageRequestDto;

interface PackageServiceInterface
{
    public function purchasePackage(PurchasePackageRequestDto $request, int $adminId): void;
}
