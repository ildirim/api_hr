<?php

namespace App\Http\Repositories\Hr;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Hr\CustomQuestion\Request\CustomQuestionRequestDto;
use App\Interfaces\Hr\CustomQuestion\CustomQuestionRepositoryInterface;
use App\Models\CustomQuestion;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CustomQuestionRepository implements CustomQuestionRepositoryInterface
{
    public function __construct(protected CustomQuestion $customQuestion)
    {
    }

    public function customQuestionsByTemplateId(int $templateId): ?LengthAwarePaginator
    {
        return $this->customQuestion->select('id', 'content')
            ->with(['answers' => function($query) {
                $query->select('id', 'custom_question_id', 'is_correct', 'answer_text');
            }])
            ->where('template_id', $templateId)
            ->orderBy('id', 'desc')
            ->paginate();
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
