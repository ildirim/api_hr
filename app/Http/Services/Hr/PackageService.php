<?php

namespace App\Http\Services\Hr;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\Package\Request\PurchasePackageRequestDto;
use App\Http\DTOs\Hr\AdminBalance\Request\AdminBalanceRequestDto;
use App\Http\DTOs\Hr\Transaction\Request\TransactionRequestDto;
use App\Http\Enums\TransactionStatusEnum;
use App\Http\Enums\TransactionTypeEnum;
use App\Interfaces\Hr\AdminBalance\AdminBalanceRepositoryInterface;
use App\Interfaces\Hr\Package\PackageRepositoryInterface;
use App\Interfaces\Hr\Package\PackageServiceInterface;
use App\Interfaces\Hr\Transaction\TransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PackageService implements PackageServiceInterface
{
    public function __construct(
        protected PackageRepositoryInterface $packageRepository,
        protected TransactionRepositoryInterface $transactionRepository,
        protected AdminBalanceRepositoryInterface $adminBalanceRepository,
    ) {
    }

    public function purchasePackage(PurchasePackageRequestDto $request, int $adminId): void
    {
        DB::transaction(function () use ($request, $adminId) {
            // Get package with template types
            $package = $this->packageRepository->packageById($request->packageId);

            if (!$package) {
                throw new NotFoundException('Package not found');
            }

            // Generate operation number if not provided
            $operationNumber = $request->operationNumber ?? 'OP-' . time() . '-' . $adminId;

            // Create transaction (symbolic) using DTO and repository
            $transactionDto = TransactionRequestDto::from([
                'adminId' => $adminId,
                'packageId' => $package->id,
                'operationNumber' => $operationNumber,
                'gatewayCode' => $request->gatewayCode,
                'amount' => $package->price,
                'currency' => $request->currency ?? 'AZN',
                'type' => TransactionTypeEnum::PURCHASE->value,
                'status' => TransactionStatusEnum::COMPLETED->value
            ]);
            $transaction = $this->transactionRepository->store($transactionDto);

            foreach ($package->templateTypes as $templateType) {
                $adminBalanceDto = AdminBalanceRequestDto::from([
                    'adminId' => $adminId,
                    'transactionId' => $transaction->id,
                    'packageId' => $package->id,
                    'templateTypeId' => $templateType->id,
                    'totalCount' => $templateType->pivot->count,
                ]);

                $this->adminBalanceRepository->store($adminBalanceDto);
            }
        });
    }
}
