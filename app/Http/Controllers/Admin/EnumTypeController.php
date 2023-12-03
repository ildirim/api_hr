<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\EnumType\Request\EnumTypeRequestDto;
use App\Http\Requests\Admin\EnumTypeRequest;
use App\Interfaces\Admin\EnumType\EnumTypeServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EnumTypeController extends Controller
{
    public function __construct(protected EnumTypeServiceInterface $enumTypeService)
    {
    }

    public function enumTypes(): JsonResponse
    {
        $enumTypes = $this->enumTypeService->enumTypes();
        return $this->success(Response::HTTP_OK, $enumTypes);
    }

    public function enumTypeById(int $id): JsonResponse
    {
        $enumType = $this->enumTypeService->enumTypeById($id);
        return $this->success(Response::HTTP_OK, $enumType);
    }

    public function store(EnumTypeRequest $request): JsonResponse
    {
        $enumTypeRequestDto = EnumTypeRequestDto::fromRequest($request);
        $enumType = $this->enumTypeService->store($enumTypeRequestDto);
        return $this->success(Response::HTTP_CREATED, $enumType);
    }

    public function update(int $id, EnumTypeRequest $request): JsonResponse
    {
        $enumTypeRequestDto = EnumTypeRequestDto::fromRequest($request);
        $enumType = $this->enumTypeService->update($id, $enumTypeRequestDto);
        return $this->success(Response::HTTP_OK, $enumType);
    }

    public function destroy($id): JsonResponse
    {
        $result = $this->enumTypeService->destroy($id);
        return $this->success(Response::HTTP_OK, $result);
    }
}
