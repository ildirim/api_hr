<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\PlanType\Request\PlanTypeRequestDto;
use App\Http\Requests\Admin\PlanTypeRequest;
use App\Interfaces\Admin\PlanType\PlanTypeServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PlanTypeController extends Controller
{
    use BaseResponse;

    public function __construct(protected PlanTypeServiceInterface $planTypeService)
    {
    }

    public function planTypes(): JsonResponse
    {
        $planTypes = $this->planTypeService->planTypes();
        return $this->success($planTypes);
    }

    public function planTypeById(int $id): JsonResponse
    {
        $planType = $this->planTypeService->planTypeById($id);
        return $this->success($planType);
    }

    public function store(PlanTypeRequest $request): JsonResponse
    {
        $dto = PlanTypeRequestDto::fromRequest($request);
        $planType = $this->planTypeService->store($dto);
        return $this->success($planType, 'Plan type created successfully', 'success', Response::HTTP_CREATED);
    }

    public function update(int $id, PlanTypeRequest $request): JsonResponse
    {
        $dto = PlanTypeRequestDto::fromRequest($request);
        $planType = $this->planTypeService->update($id, $dto);
        return $this->success($planType);
    }

    public function destroy(int $id): JsonResponse
    {
        $planType = $this->planTypeService->destroy($id);
        return $this->success($planType);
    }
}


