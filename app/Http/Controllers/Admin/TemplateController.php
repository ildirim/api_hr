<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\Template\Request\TemplateRequestDto;
use App\Http\Requests\Admin\TemplateRequest;
use App\Interfaces\Admin\Template\TemplateServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TemplateController extends Controller
{
    public function __construct(protected TemplateServiceInterface $templateService)
    {
    }

    public function store(TemplateRequest $request): JsonResponse
    {
        $templateRequestDto = TemplateRequestDto::fromRequest($request);
        $template = $this->templateService->store($templateRequestDto);
        return $this->success(Response::HTTP_CREATED, $template);
    }
}
