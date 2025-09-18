<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\Template\Request\TemplateRequestDto;
use App\Http\Requests\Admin\TemplateRequest;
use App\Interfaces\Admin\Template\TemplateServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TemplateController extends Controller
{
    use BaseResponse;

    public function __construct(protected TemplateServiceInterface $templateService)
    {
    }

    public function getTemplatesByCompanyId(): JsonResponse
    {
        $templates = $this->templateService->getTemplatesByCompanyId(auth('admin')->user()->company_id);
        return $this->success($templates);
    }

    public function store(TemplateRequest $request): JsonResponse
    {
        $templateRequestDto = TemplateRequestDto::from($request->validated());
        $template = $this->templateService->store($templateRequestDto);
        return $this->success($template, 'Template created successfully', 'success', Response::HTTP_CREATED);
    }
}
