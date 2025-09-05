<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Hr\TemplateCategory\Request\TemplateCategoryListRequestDto;
use App\Http\Requests\Hr\TemplateCategoryRequest;
use App\Interfaces\Hr\TemplateCategory\TemplateCategoryServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TemplateCategoryController extends Controller
{
    use BaseResponse;

    public function __construct(protected TemplateCategoryServiceInterface $templateCategoryService)
    {
    }

    public function store(TemplateCategoryRequest $request): JsonResponse
    {
        $requestDto = TemplateCategoryListRequestDto::fromRequest($request);
        $questionCategories = $this->templateCategoryService->storeList($requestDto);
        return $this->success($questionCategories);
    }
}
