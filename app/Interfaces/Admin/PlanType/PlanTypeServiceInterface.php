<?php

namespace App\Interfaces\Admin\PlanType;

use App\Http\DTOs\Admin\PlanType\Request\PlanTypeRequestDto;
use App\Http\DTOs\Admin\PlanType\Response\PlanTypeResponseDto;
use Spatie\LaravelData\DataCollection;

interface PlanTypeServiceInterface
{
    public function planTypes(): DataCollection;

    public function planTypeById(int $id): ?PlanTypeResponseDto;

    public function store(PlanTypeRequestDto $request): PlanTypeResponseDto;

    public function update(int $id, PlanTypeRequestDto $request): PlanTypeResponseDto;

    public function destroy(int $id): void;
}
