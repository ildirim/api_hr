<?php

namespace App\Http\Services\Hr;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Http\DTOs\Hr\Template\Request\TemplateQuestionDto;
use App\Http\DTOs\Hr\Template\Request\TemplateStoreDto;
use App\Http\DTOs\Hr\Template\Request\TemplateUpdateDto;
use App\Http\DTOs\Hr\Template\Response\TemplateByIdResponseDto;
use App\Http\DTOs\Hr\TemplateCategory\Request\TemplateCategoryStoreDto;
use App\Http\Enums\SubscriptionPlanEnum;
use App\Http\Enums\TemplateStatusEnum;
use App\Interfaces\Hr\Template\TemplateRepositoryInterface;
use App\Interfaces\Hr\Template\TemplateServiceInterface;
use App\Interfaces\Hr\TemplateCategory\TemplateCategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TemplateService implements TemplateServiceInterface
{
    public function __construct(
        protected TemplateRepositoryInterface $templateRepository,
        protected TemplateCategoryRepositoryInterface $templateCategoryRepository,
    )
    {
    }

    public function getTemplateById(int $id): ?TemplateByIdResponseDto
    {
        $template = $this->templateRepository->getTemplateById($id);
        if (!$template) {
            return null;
        }
        return TemplateByIdResponseDto::from($template);
    }

    public function store(TemplateStoreDto $templateStoreDto): void
    {
        $this->templateRepository->store($templateStoreDto);
    }

    public function storeQuestions(int $id, TemplateQuestionDto $templateQuestionDto): void
    {
        DB::transaction(function () use ($id, $templateQuestionDto) {
            $template = $this->templateRepository->getTemplateById($id);
            if (!$template) {
                throw new NotFoundException();
            }

            $templateCategoryStoreDto = TemplateCategoryStoreDto::from([
                'templateId' => $template->id,
                'questionCategoryId' => $templateQuestionDto->questionCategoryId,
                'duration' => 0,
                'isGrouped' => false
            ]);
            $templateCategory = $this->templateCategoryRepository->store($templateCategoryStoreDto);;
            $templateCategory->questions()->attach($templateQuestionDto->questionIds);

            $templateUpdateDto = TemplateUpdateDto::from([
                'status' => TemplateStatusEnum::INCOMPLETED_STEP2->value,
            ]);
            $this->templateRepository->update($template, $templateUpdateDto);
        });
    }

    public function update(int $id, TemplateUpdateDto $templateUpdateDto): void
    {
        $template = $this->templateRepository->getTemplateById($id);
        if (!$template) {
            throw new NotFoundException();
        }
        if ($template->status < TemplateStatusEnum::INCOMPLETED_STEP3->value) {
            throw new BadRequestException('Stage is wrong');
        }
        $this->templateRepository->update($template, $templateUpdateDto);
    }
}
