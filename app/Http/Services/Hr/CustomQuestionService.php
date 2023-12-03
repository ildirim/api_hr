<?php

namespace App\Http\Services\Hr;

use App\Http\DTOs\Hr\CustomQuestion\Request\CustomQuestionRequestDto;
use App\Http\DTOs\Hr\CustomQuestion\Response\CustomQuestionResponseDto;
use App\Interfaces\Hr\CustomQuestion\CustomQuestionRepositoryInterface;
use App\Interfaces\Hr\CustomQuestion\CustomQuestionServiceInterface;
use App\Models\CustomQuestion;
use Spatie\LaravelData\DataCollection;

class CustomQuestionService implements CustomQuestionServiceInterface
{
    public function __construct(protected CustomQuestionRepositoryInterface $customQuestionRepository)
    {
    }

    public function customQuestionsByTemplateCategoryId(int $templateCategoryId): DataCollection
    {
        $customQuestions = $this->customQuestionRepository->customQuestionsByTemplateCategoryId($templateCategoryId);
        return CustomQuestionResponseDto::collection($customQuestions);
    }

    public function customQuestionById(int $id): CustomQuestionResponseDto
    {
        $customQuestions = $this->customQuestionRepository->customQuestionsById($id);
        return CustomQuestionResponseDto::from($customQuestions);
    }

    public function store(CustomQuestionRequestDto $requestDto): CustomQuestion
    {
        return $this->customQuestionRepository->store($requestDto);
    }

    public function update(int $id, CustomQuestionRequestDto $requestDto): CustomQuestion
    {
        return $this->customQuestionRepository->update($id, $requestDto);
    }
}
