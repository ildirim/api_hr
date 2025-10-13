<?php

namespace App\Http\Repositories\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\QuestionCategory\Request\QuestionCategoryRequestDto;
use App\Interfaces\Admin\QuestionCategory\QuestionCategoryRepositoryInterface;
use App\Models\QuestionCategory;
use App\Models\QuestionCategoryTranslation;
use Illuminate\Support\Collection;

class QuestionCategoryRepository implements QuestionCategoryRepositoryInterface
{
    public function __construct(protected QuestionCategory $questionCategory)
    {
    }

    public function questionCategories(): Collection
    {
        return $this->questionCategory->with(['translations' => function ($query) {
            $query->select('id', 'question_category_id', 'language_id', 'name');
        }])
            ->select('id')
            ->get();
    }

    public function questionCategoryById(int $id): QuestionCategory
    {
        $questionCategory = $this->questionCategory->with(['translations' => function ($query) {
            $query->select('id', 'question_category_id', 'language_id', 'name');
        }])
            ->select('id')
            ->find($id);
        if (!$questionCategory) {
            throw new NotFoundException('Kateqoriya tapılmadı');
        }
        return $questionCategory;
    }

    public function store(): QuestionCategory
    {
        return $this->questionCategory->create();
    }

    public function update(int $id, QuestionCategoryRequestDto $request): QuestionCategory
    {
        $questionCategory = $this->questionCategory->find($id);
        if (!$questionCategory) {
            throw new NotFoundException('Kateqoriya tapılmadı');
        }
        $questionCategory->update($request->toArray());

        return $questionCategory;
    }

    public function updateTranslations(int $id, array $request): bool
    {
        return QuestionCategoryTranslation::where('id', $id)->update($request);
    }

    public function updateQuestionCategory(int $id, array $request): bool
    {
        return QuestionCategoryTranslation::where('id', $id)->update($request);
    }

    public function destroy(int $id): QuestionCategory
    {
        $questionCategory = $this->questionCategory->find($id);
        if (!$questionCategory) {
            throw new NotFoundException('Kateqoriya tapılmadı');
        }
        $questionCategory->delete();

        return $questionCategory;
    }
}
