<?php

namespace App\Http\Services\Hr;

use App\Http\DTOs\Hr\CustomQuestion\Request\CustomQuestionRequestDto;
use App\Http\DTOs\Hr\CustomQuestion\Response\CustomQuestionResponseDto;
use App\Interfaces\Hr\CustomQuestion\CustomQuestionRepositoryInterface;
use App\Interfaces\Hr\CustomQuestion\CustomQuestionServiceInterface;
use App\Models\CustomQuestion;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

class CustomQuestionService implements CustomQuestionServiceInterface
{
    public function __construct(protected CustomQuestionRepositoryInterface $customQuestionRepository)
    {
    }

    public function customQuestionsByTemplateId(int $templateId): ?PaginatedDataCollection
    {
        $customQuestions = $this->customQuestionRepository->customQuestionsByTemplateId($templateId);
        return CustomQuestionResponseDto::collection($customQuestions);
    }

    public function customQuestionById(int $id): CustomQuestionResponseDto
    {
        $customQuestions = $this->customQuestionRepository->customQuestionsById($id);
        return CustomQuestionResponseDto::from($customQuestions);
    }

    public function store(CustomQuestionRequestDto $request): CustomQuestion
    {
        return $this->customQuestionRepository->store($request);
    }

    public function update(int $id, CustomQuestionRequestDto $requestDto): CustomQuestion
    {
        return $this->customQuestionRepository->update($id, $requestDto);
    }
}
