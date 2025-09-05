<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\EnumData\Request\EnumDataRequestDto;
use App\Http\Requests\Admin\EnumDataRequest;
use App\Interfaces\Admin\EnumData\EnumDataServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EnumDataController extends Controller
{
    use BaseResponse;

    public function __construct(protected EnumDataServiceInterface $enumDataService)
    {
    }

    public function enumDatas(): JsonResponse
    {
        $enumDatas = $this->enumDataService->enumDatas();
        return $this->success($enumDatas);
    }

    public function enumDataById(int $id): JsonResponse
    {
        $enumData = $this->enumDataService->enumDataById($id);
        return $this->success($enumData);
    }

    public function store(EnumDataRequest $request): JsonResponse
    {
        $enumDataRequestDto = EnumDataRequestDto::fromRequest($request);
        $enumData = $this->enumDataService->store($enumDataRequestDto);
        return $this->success($enumData, 'Enum data created successfully', 'success', Response::HTTP_CREATED);
    }

    public function update(int $id, EnumDataRequest $request): JsonResponse
    {
        $enumDataRequestDto = EnumDataRequestDto::fromRequest($request);
        $enumData = $this->enumDataService->update($id, $enumDataRequestDto);
        return $this->success($enumData);
    }

    public function destroy($id): JsonResponse
    {
        $result = $this->enumDataService->destroy($id);
        return $this->success($result);
    }
}
