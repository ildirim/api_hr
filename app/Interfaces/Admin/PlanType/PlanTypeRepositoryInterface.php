<?php

namespace App\Interfaces\Admin\PlanType;

use App\Models\PlanType;
use Illuminate\Support\Collection;

interface PlanTypeRepositoryInterface
{
    public function planTypes(): Collection;

    public function planTypeById(int $id): ?PlanType;

    public function store(array $data): PlanType;

    public function update(int $id, array $data): PlanType;

    public function destroy(PlanType $planType): bool;
}


