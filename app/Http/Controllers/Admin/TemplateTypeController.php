<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\TemplateType\Request\TemplateTypeRequestDto;
use App\Http\Requests\Admin\TemplateTypeRequest;
use App\Interfaces\Admin\TemplateType\TemplateTypeServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TemplateTypeController extends Controller
{
    use BaseResponse;

    public function __construct(protected TemplateTypeServiceInterface $templateTypeService)
    {
    }

    public function templateTypes(): JsonResponse
    {
        $templateTypes = $this->templateTypeService->templateTypes();
        return $this->success($templateTypes);
    }

    public function templateTypeById(int $id): JsonResponse
    {
        $templateType = $this->templateTypeService->templateTypeById($id);
        return $this->success($templateType);
    }

    public function store(TemplateTypeRequestDto $request): JsonResponse
    {
        $templateType = $this->templateTypeService->store($request);
        return $this->success($templateType, 'Template type created successfully', 'success', Response::HTTP_CREATED);
    }

    public function update(int $id, TemplateTypeRequestDto $request): JsonResponse
    {
        $templateType = $this->templateTypeService->update($id, $request);
        return $this->success($templateType);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->templateTypeService->destroy($id);
        return $this->success(null);
    }
}
