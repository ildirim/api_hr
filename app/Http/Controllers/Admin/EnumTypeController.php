<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\EnumType\Request\EnumTypeRequestDto;
use App\Http\Requests\Admin\EnumTypeRequest;
use App\Interfaces\Admin\EnumType\EnumTypeServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Nette\Schema\Elements\Base;
use Symfony\Component\HttpFoundation\Response;

class EnumTypeController extends Controller
{
    use BaseResponse;

    public function __construct(protected EnumTypeServiceInterface $enumTypeService)
    {
    }

    public function enumTypes(): JsonResponse
    {
        $enumTypes = $this->enumTypeService->enumTypes();
        return $this->success($enumTypes);
    }

    public function enumTypeById(int $id): JsonResponse
    {
        $enumType = $this->enumTypeService->enumTypeById($id);
        return $this->success($enumType);
    }

    public function store(EnumTypeRequest $request): JsonResponse
    {
        $enumTypeRequestDto = EnumTypeRequestDto::fromRequest($request);
        $enumType = $this->enumTypeService->store($enumTypeRequestDto);
        return $this->success($enumType, 'Enum type created successfully', 'success', Response::HTTP_CREATED);
    }

    public function update(int $id, EnumTypeRequest $request): JsonResponse
    {
        $enumTypeRequestDto = EnumTypeRequestDto::fromRequest($request);
        $enumType = $this->enumTypeService->update($id, $enumTypeRequestDto);
        return $this->success($enumType);
    }

    public function destroy($id): JsonResponse
    {
        $result = $this->enumTypeService->destroy($id);
        return $this->success($result);
    }
}
