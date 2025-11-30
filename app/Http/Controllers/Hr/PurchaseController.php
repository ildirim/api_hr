<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\Package\Request\PurchasePackageRequestDto;
use App\Interfaces\Hr\Package\PackageServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PurchaseController extends Controller
{
    use BaseResponse;

    public function __construct(protected PackageServiceInterface $packageService)
    {
    }

    public function purchase(PurchasePackageRequestDto $request): JsonResponse
    {
        $adminId = Auth::guard('admin')->id();
        $this->packageService->purchasePackage($request, $adminId);
        return $this->success(null, 'Package purchased successfully. Balance added to your account.', 'success', Response::HTTP_CREATED);
    }
}
