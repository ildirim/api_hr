<?php

namespace App\Http\Repositories\Hr;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Hr\CustomQuestion\Request\CustomQuestionRequestDto;
use App\Interfaces\Hr\CustomQuestion\CustomQuestionRepositoryInterface;
use App\Models\CustomQuestion;
use Illuminate\Support\Collection;

class CustomQuestionRepository implements CustomQuestionRepositoryInterface
{
    public function __construct(protected CustomQuestion $customQuestion)
    {
    }

    public function customQuestionsByTemplateCategoryId(int $templateCategoryId): Collection
    {
        return $this->customQuestion->select('id', 'content')
            ->with(['answers' => function($query) {
                $query->select('id', 'custom_question_id', 'is_correct', 'name');
            }])
            ->where('template_category_id', $templateCategoryId)
            ->get();
    }

    public function store(CustomQuestionRequestDto $requestDto): CustomQuestion
    {
        return $this->customQuestion->create(CustomQuestionRequestDto::toLower($requestDto->toArray()));
    }

    public function update(int $id, CustomQuestionRequestDto $requestDto): CustomQuestion
    {
        $customQuestion = $this->customQuestion->find($id);
        if (!$customQuestion) {
            throw new NotFoundException('Sual tapılmadı');
        }
        $customQuestion->update($requestDto->toArray());
        return $customQuestion;
    }

    public function destroy(int $id): CustomQuestion
    {
        $customQuestion = $this->customQuestion->find($id);
        if (!$customQuestion) {
            throw new NotFoundException('Sual tapılmadı');
        }
        $customQuestion->delete();
        return $customQuestion;
    }
}
