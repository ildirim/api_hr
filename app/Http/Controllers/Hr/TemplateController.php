<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Hr\Template\Request\TemplateQuestionDto;
use App\Http\DTOs\Hr\Template\Request\TemplateSettingDto;
use App\Http\DTOs\Hr\Template\Request\TemplateStoreDto;
use App\Http\DTOs\Hr\Template\Request\TemplateStoreUpdateDto;
use App\Http\DTOs\Hr\Template\Request\TemplateUpdateDto;
use App\Interfaces\Hr\Template\TemplateServiceInterface;
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
        $templates = $this->templateService->getTemplatesByCompanyId();
        return $this->success($templates);
    }

    public function getTemplateById(int $id): JsonResponse
    {
        $template = $this->templateService->getTemplateById($id);
        return $this->success($template);
    }

    public function store(TemplateStoreDto $templateStoreDto): JsonResponse
    {
        $template = $this->templateService->store($templateStoreDto);
        return $this->success($template, 'Template created successfully', 'success', Response::HTTP_CREATED);
    }

    public function storeQuestions(int $id, TemplateQuestionDto $templateQuestionDto): JsonResponse
    {
        $this->templateService->storeQuestions($id, $templateQuestionDto);
        return $this->success(null, 'Questions stored successfully');
    }

    public function updateQuestions(int $id, TemplateQuestionDto $templateQuestionDto): JsonResponse
    {
        $this->templateService->updateQuestions($id, $templateQuestionDto);
        return $this->success(null, 'Questions updated successfully');
    }

    public function storeSettings(int $id, TemplateSettingDto $templateSettingDto): JsonResponse
    {
        $this->templateService->storeSettings($id, $templateSettingDto);
        return $this->success(null, 'Settings stored successfully');
    }

    public function updateSettings(int $id, TemplateSettingDto $templateSettingDto): JsonResponse
    {
        $this->templateService->updateSettings($id, $templateSettingDto);
        return $this->success(null, 'Settings updated successfully');
    }

    public function update(int $id, TemplateUpdateDto $templateUpdateDto): JsonResponse
    {
        $this->templateService->update($id, $templateUpdateDto);
        return $this->success(null, 'Template updated successfully');
    }

    public function updateStore(int $id, TemplateStoreUpdateDto $templateStoreUpdateDto): JsonResponse
    {
        $this->templateService->updateStore($id, $templateStoreUpdateDto);
        return $this->success(null, 'Template store data updated successfully');
    }
}
