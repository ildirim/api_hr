<?php

namespace App\Http\Services\Hr;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Http\DTOs\Hr\Template\Request\TemplateCategoryRequestDto;
use App\Http\DTOs\Hr\Template\Request\TemplateQuestionDto;
use App\Http\DTOs\Hr\Template\Request\TemplateSettingDto;
use App\Http\DTOs\Hr\Template\Request\TemplateStoreDto;
use App\Http\DTOs\Hr\Template\Request\TemplateStoreUpdateDto;
use App\Http\DTOs\Hr\Template\Request\TemplateUpdateDto;
use App\Http\DTOs\Hr\Template\Response\TemplateByIdResponseDto;
use App\Http\DTOs\Hr\Template\Response\TemplateListResponseDto;
use App\Http\DTOs\Hr\TemplateCategory\Request\TemplateCategoryStoreDto;
use App\Http\Enums\TemplateStepEnum;
use App\Interfaces\Hr\Template\TemplateRepositoryInterface;
use App\Interfaces\Hr\Template\TemplateServiceInterface;
use App\Interfaces\Hr\TemplateCategory\TemplateCategoryRepositoryInterface;
use App\Models\TemplateCategory;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\PaginatedDataCollection;


class TemplateService implements TemplateServiceInterface
{
    public function __construct(
        protected TemplateRepositoryInterface $templateRepository,
        protected TemplateCategoryRepositoryInterface $templateCategoryRepository,
    )
    {
    }

    public function getTemplatesByCompanyId(): ?PaginatedDataCollection
    {
        $companyId = auth('admin')->user()->company_id;
        if (!$companyId) {
            throw new NotFoundException('Company not found');
        }
        $templates = $this->templateRepository->getTemplatesByCompanyId($companyId);
        return TemplateListResponseDto::collection($templates);
    }

    public function getTemplateById(int $id): ?TemplateByIdResponseDto
    {
        $template = $this->templateRepository->getTemplateDetailsById($id);
        if (!$template) {
            return null;
        }
        return TemplateByIdResponseDto::from($template);
    }

    public function store(TemplateStoreDto $templateStoreDto): TemplateByIdResponseDto
    {
        if (!$templateStoreDto->companyId) {
            throw new NotFoundException('Company not found');
        }
        return TemplateByIdResponseDto::from($this->templateRepository->store($templateStoreDto));
    }

    public function storeQuestions(int $id, TemplateQuestionDto $templateQuestionDto): void
    {
        DB::transaction(function () use ($id, $templateQuestionDto) {
            $template = $this->templateRepository->getTemplateById($id);
            if (!$template) {
                throw new NotFoundException();
            }
            if ($template->status > TemplateStepEnum::STEP1_CREATION->value) {
                throw new BadRequestException('Stage is wrong');
            }
            foreach ($templateQuestionDto->templateCategories as $templateCategoryDto) {
                $templateCategory = $this->storeTemplateCategory($id, $templateCategoryDto);

                $questions = collect($templateCategoryDto->questions);
                $this->storeTemplateCategoryQuestions($questions, $templateCategory);
            }

            $templateUpdateDto = TemplateUpdateDto::from([
                'currentStep' => $templateQuestionDto->currentStep,
            ]);
            $this->templateRepository->update($template, $templateUpdateDto);
        });
    }

    public function updateQuestions(int $id, TemplateQuestionDto $templateQuestionDto): void
    {
        DB::transaction(function () use ($id, $templateQuestionDto) {
            $template = $this->templateRepository->getTemplateById($id);
            if (!$template) {
                throw new NotFoundException();
            }
            if ($template->current_step > TemplateStepEnum::STEP2_QUESTIONS->value) {
                throw new BadRequestException('Stage is wrong');
            }

            // delete existing template categories and their questions
            $template->templateCategories->each(function ($templateCategory) {
                $templateCategory->questions()->detach();
                $templateCategory->customQuestions()->detach();
                $templateCategory->delete();
            });

            // recreate from request
            foreach ($templateQuestionDto->templateCategories as $templateCategoryDto) {
                $templateCategory = $this->storeTemplateCategory($id, $templateCategoryDto);

                $questions = collect($templateCategoryDto->questions);
                $this->storeTemplateCategoryQuestions($questions, $templateCategory);
            }

            $templateUpdateDto = TemplateUpdateDto::from([
                'currentStep' => $templateQuestionDto->currentStep,
            ]);
            $this->templateRepository->update($template, $templateUpdateDto);
        });
    }

    private function storeTemplateCategory(int $templateId, TemplateCategoryRequestDto $templateCategoryDto): TemplateCategory
    {
        $templateCategoryStoreDto = TemplateCategoryStoreDto::from([
            'templateId' => $templateId,
            'questionCategoryId' => $templateCategoryDto->questionCategoryId,
            'duration' => $templateCategoryDto?->duration,
            'orderNumber' => $templateCategoryDto->orderNumber,
        ]);
        return $this->templateCategoryRepository->store($templateCategoryStoreDto);
    }

    private function storeTemplateCategoryQuestions($questions, TemplateCategory $templateCategory): void
    {
        $questionsData = $questions->mapWithKeys(fn ($q) => [
            $q['id'] => [
                'order_number' => $q['orderNumber'] ?? 0,
                'duration' => $q['duration'] ?? 0,
            ]
        ])
            ->toArray();
        $templateCategory->questions()->attach($questionsData);
    }

    public function storeSettings(int $id, TemplateSettingDto $templateSettingDto): void
    {
        $template = $this->templateRepository->getTemplateById($id);
        if (!$template) {
            throw new NotFoundException();
        }
        if ($template->current_step > TemplateStepEnum::STEP2_QUESTIONS->value) {
            throw new BadRequestException('Stage is wrong');
        }

        $templateUpdateDto = TemplateUpdateDto::from($templateSettingDto->toArray());
        $this->templateRepository->update($template, $templateUpdateDto);
    }

    public function update(int $id, TemplateUpdateDto $templateUpdateDto): void
    {
        $template = $this->templateRepository->getTemplateById($id);
        if (!$template) {
            throw new NotFoundException();
        }
        if ($template->current_step < TemplateStepEnum::STEP3_CONFIGURATION->value) {
            throw new BadRequestException('Stage is wrong');
        }
        $this->templateRepository->update($template, $templateUpdateDto);
    }

    public function updateStore(int $id, TemplateStoreUpdateDto $templateStoreUpdateDto): void
    {
        $template = $this->templateRepository->getTemplateById($id);
        if (!$template) {
            throw new NotFoundException();
        }
        if ($template->current_step > TemplateStepEnum::STEP3_CONFIGURATION->value) {
            throw new BadRequestException('Stage is wrong');
        }
        $this->templateRepository->updateStore($template, $templateStoreUpdateDto);
    }
}
