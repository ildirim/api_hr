<?php

namespace App\Interfaces\Hr\AdminBalance;

use App\Http\DTOs\Hr\AdminBalance\Request\AdminBalanceRequestDto;
use App\Models\AdminBalance;

interface AdminBalanceRepositoryInterface
{
    public function store(AdminBalanceRequestDto $request): AdminBalance;

    public function getAvailableBalance(int $adminId, int $templateTypeId): ?AdminBalance;

    public function incrementUsedCount(AdminBalance $adminBalance): void;
}
