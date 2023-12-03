<?php

namespace App\Http\Services\Admin;

use App\Http\DTOs\Admin\QuestionCategory\Request\QuestionCategoryRequestDto;
use App\Http\DTOs\Admin\QuestionCategory\Response\QuestionCategoryResponseDto;
use App\Interfaces\Admin\QuestionCategory\QuestionCategoryRepositoryInterface;
use App\Interfaces\Admin\QuestionCategory\QuestionCategoryServiceInterface;
use App\Models\QuestionCategory;
use Spatie\LaravelData\DataCollection;

class QuestionCategoryService implements QuestionCategoryServiceInterface
{
    public function __construct(protected QuestionCategoryRepositoryInterface $questionCategoryRepository)
    {
    }

    public function questionCategories(): DataCollection
    {
        return QuestionCategoryResponseDto::collection($this->questionCategoryRepository->questionCategories());
    }

    public function questionCategoryById(int $id): QuestionCategoryResponseDto
    {
        return QuestionCategoryResponseDto::from($this->questionCategoryRepository->questionCategoryById($id));
    }

    public function store(QuestionCategoryRequestDto $request): QuestionCategoryResponseDto
    {
        $questionCategoryTranslationRequest = $request->toArray()['translations'];
        $questionCategory = $this->questionCategoryRepository->store();
        $questionCategory->translations()->createMany($questionCategoryTranslationRequest);
        return QuestionCategoryResponseDto::from($questionCategory);
    }

    public function update(int $id, QuestionCategoryRequestDto $request): QuestionCategoryResponseDto
    {
        $questionCategory = $this->questionCategoryRepository->update($id, $request);
        $this->updateTranslation($questionCategory, $request);
        return QuestionCategoryResponseDto::from($questionCategory);
    }

    public function updateTranslation(QuestionCategory $questionCategory, QuestionCategoryRequestDto $request): void
    {
        $questionCategoryTranslationRequest = $request->toArray()['translations'];
        foreach ($questionCategoryTranslationRequest as $questionCategoryTranslation) {
            if (isset($questionCategoryTranslation['id'])) {
                $this->questionCategoryRepository->updateTranslations($questionCategoryTranslation['id'], $questionCategoryTranslation);
            } else {
                $questionCategory->translations()->create($questionCategoryTranslation);
            }
        }
    }

    public function destroy(int $id): QuestionCategoryResponseDto
    {
        return QuestionCategoryResponseDto::from($this->questionCategoryRepository->destroy($id));
    }
}
