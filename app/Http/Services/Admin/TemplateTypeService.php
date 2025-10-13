<?php

namespace App\Http\Services\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\TemplateType\Request\QuestionCategoryRequestDto;
use App\Http\DTOs\Admin\TemplateType\Request\TemplateTypeRequestDto;
use App\Http\DTOs\Admin\TemplateType\Response\TemplateTypeResponseDto;
use App\Interfaces\Admin\QuestionCategory\QuestionCategoryRepositoryInterface;
use App\Interfaces\Admin\TemplateType\TemplateTypeRepositoryInterface;
use App\Interfaces\Admin\TemplateType\TemplateTypeServiceInterface;
use App\Models\TemplateType;
use Spatie\LaravelData\DataCollection;

class TemplateTypeService implements TemplateTypeServiceInterface
{
    public function __construct(
        protected TemplateTypeRepositoryInterface $templateTypeRepository,
        protected QuestionCategoryRepositoryInterface $questionCategoryRepository,
    )
    {
    }

    public function templateTypes(): DataCollection
    {
        return TemplateTypeResponseDto::collection($this->templateTypeRepository->templateTypes());
    }

    public function templateTypeById(int $id): ?TemplateTypeResponseDto
    {
        $templateType = $this->templateTypeRepository->templateTypeById($id);
        if (!$templateType) {
            return null;
        }
        return TemplateTypeResponseDto::from($templateType);
    }

    public function store(TemplateTypeRequestDto $request): void
    {
        $templateType = $this->templateTypeRepository->store($request);
        $questionCategories = QuestionCategoryRequestDto::toLower($request->questionCategories->toArray());
        $templateType->questionCategories()->attach($questionCategories);
    }

    public function update(int $id, TemplateTypeRequestDto $request): void
    {
        $templateType = $this->templateTypeRepository->update($id, $request);
        $this->updateQuestionCategories($templateType, $request);
    }

    public function updateQuestionCategories(TemplateType $templateType, TemplateTypeRequestDto $request): void
    {
        $storedQuestionCategories = [];
        $questionCategories = QuestionCategoryRequestDto::toLower($request->questionCategories->toArray());
        foreach ($questionCategories as $questionCategory) {
            if (isset($questionCategory->id)) {
                $this->questionCategoryRepository->updateQuestionCategory($questionCategory->id, $questionCategory);
            } else {
                $storedQuestionCategories[] =  $questionCategory;
            }
        }
        $templateType->questionCategories()->attach($storedQuestionCategories);
    }

    public function destroy(int $id): void
    {
        $templateType = $this->templateTypeRepository->templateTypeById($id);
        if (!$templateType) {
            throw new NotFoundException('Template Type not found');
        }
        $this->templateTypeRepository->destroy($templateType);
    }
}
