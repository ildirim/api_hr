<?php

namespace App\Http\Repositories\Hr;

use App\Http\DTOs\Hr\AdminBalance\Request\AdminBalanceRequestDto;
use App\Interfaces\Hr\AdminBalance\AdminBalanceRepositoryInterface;
use App\Models\AdminBalance;
use Illuminate\Support\Facades\DB;

class AdminBalanceRepository implements AdminBalanceRepositoryInterface
{
    public function __construct(protected AdminBalance $adminBalance)
    {
    }

    public function store(AdminBalanceRequestDto $request): AdminBalance
    {
        $data = AdminBalanceRequestDto::toLower($request->toArray());
        return $this->adminBalance->create($data);
    }

    public function getAvailableBalance(int $adminId, int $templateTypeId): ?AdminBalance
    {
        return $this->adminBalance
            ->where('admin_id', $adminId)
            ->where('template_type_id', $templateTypeId)
            ->whereColumn('used_count', '<', 'total_count')
            ->orderBy('created_at', 'asc')
            ->first();
    }

    public function incrementUsedCount(AdminBalance $adminBalance): void
    {
        $adminBalance->increment('used_count');
    }
}
