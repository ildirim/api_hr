<?php

namespace App\Http\Services\Hr;

use App\Http\DTOs\Hr\TemplateCategory\Request\TemplateCategoryAndQuestionsRequestDto;
use App\Http\DTOs\Hr\TemplateCategory\Request\TemplateCategoryListRequestDto;
use App\Http\DTOs\Hr\TemplateCategory\Request\TemplateCategoryRequestDto;
use App\Http\Mappers\Hr\TemplateCategoryQuestion\TemplateCategoryQuestionRequestMapper;
use App\Interfaces\Hr\TemplateCategory\TemplateCategoryRepositoryInterface;
use App\Interfaces\Hr\TemplateCategory\TemplateCategoryServiceInterface;
use App\Models\TemplateCategory;
use Illuminate\Support\Facades\DB;

class TemplateCategoryService implements TemplateCategoryServiceInterface
{
    public function __construct(protected TemplateCategoryRepositoryInterface $templateCategoryRepository)
    {
    }

    public function storeList(TemplateCategoryListRequestDto $requestDto): bool
    {
        DB::transaction(function () use ($requestDto) {
            $templateCategories = $requestDto->toArray()['templateCategories'];
            foreach ($templateCategories as $templateCategory) {
                $templateCategoryAndQuestionsDto = TemplateCategoryAndQuestionsRequestDto::from($templateCategory);
                $templateCategoryDto = TemplateCategoryRequestDto::from($templateCategoryAndQuestionsDto);
                $storedTemplateCategory = $this->store($templateCategoryDto);
                $templateCategoryAndQuestionsArray = $templateCategoryAndQuestionsDto->toArray();

                // question store
                $templateCategoryQuestions =
                    TemplateCategoryQuestionRequestMapper::questionRequestToDto(
                        $templateCategoryAndQuestionsArray['questions'],
                    );
                $storedTemplateCategory->questions()->attach($templateCategoryQuestions->toArray());
                // end question store

                // custom question store
                $templateCategoryCustomQuestions =
                    TemplateCategoryQuestionRequestMapper::customQuestionRequestToDto(
                        $templateCategoryAndQuestionsArray['custom_questions'],
                    );
                $storedTemplateCategory->customQuestions()->attach($templateCategoryCustomQuestions->toArray());
                // end custom question store
            }
        });
        return true;
    }

    public function store(TemplateCategoryRequestDto $request): TemplateCategory
    {
        return $this->templateCategoryRepository->store($request);
    }
}
