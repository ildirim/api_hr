<?php

namespace App\Http\Services\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\PlanType\Request\PlanTypeRequestDto;
use App\Http\DTOs\Admin\PlanType\Response\PlanTypeResponseDto;
use App\Interfaces\Admin\PlanType\PlanTypeRepositoryInterface;
use App\Interfaces\Admin\PlanType\PlanTypeServiceInterface;
use Spatie\LaravelData\DataCollection;

class PlanTypeService implements PlanTypeServiceInterface
{
    public function __construct(protected PlanTypeRepositoryInterface $planTypeRepository)
    {
    }

    public function planTypes(): DataCollection
    {
        return PlanTypeResponseDto::collection($this->planTypeRepository->planTypes());
    }

    public function planTypeById(int $id): ?PlanTypeResponseDto
    {
        $planType = $this->planTypeRepository->planTypeById($id);
        if (!$planType) {
            return null;
        }
        return PlanTypeResponseDto::from($planType);
    }

    public function store(PlanTypeRequestDto $request): PlanTypeResponseDto
    {
        $planType = $this->planTypeRepository->store($request->toArray());
        return PlanTypeResponseDto::from($planType);
    }

    public function update(int $id, PlanTypeRequestDto $request): PlanTypeResponseDto
    {
        $planType = $this->planTypeRepository->update($id, $request->toArray());
        return PlanTypeResponseDto::from($planType);
    }

    public function destroy(int $id): void
    {
        $planType = $this->planTypeRepository->planTypeById($id);
        if (!$planType) {
            throw new NotFoundException('Plan Type not found');
        }
        $this->planTypeRepository->destroy($planType);
    }
}
