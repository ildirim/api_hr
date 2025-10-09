<?php

namespace App\Http\Repositories\Admin;

use App\Http\Enums\LanguageEnum;
use App\Interfaces\Admin\PlanType\PlanTypeRepositoryInterface;
use App\Models\PlanType;
use Illuminate\Support\Collection;

class PlanTypeRepository implements PlanTypeRepositoryInterface
{
    public function __construct(protected PlanType $planType)
    {
    }

    public function planTypes(): Collection
    {
        return $this->planType->select('id', 'name')->get();
    }

    public function planTypeById(int $id): ?PlanType
    {
        return $this->planType->select('id', 'name')->find($id);
    }

    public function store(array $data): PlanType
    {
        return $this->planType->create($data);
    }

    public function update(int $id, array $data): PlanType
    {
        $planType = $this->planType->findOrFail($id);
        $planType->update($data);
        return $planType;
    }

    public function destroy(PlanType $planType): bool
    {
        return $planType->delete();
    }
}


