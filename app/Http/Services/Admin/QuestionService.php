<?php

namespace App\Http\Services\Admin;

use App\Http\DTOs\Admin\Question\Request\QuestionRequestDto;
use App\Http\DTOs\Admin\Question\Request\QuestionSelectRequestDto;
use App\Http\DTOs\Admin\Question\Response\QuestionResponseDto;
use App\Interfaces\Admin\Question\QuestionRepositoryInterface;
use App\Interfaces\Admin\Question\QuestionServiceInterface;
use App\Models\Question;
use Spatie\LaravelData\DataCollection;

class QuestionService implements QuestionServiceInterface
{
    public function __construct(protected QuestionRepositoryInterface $questionRepository)
    {
    }

    public function questions(QuestionSelectRequestDto $questionSelectRequestDto): DataCollection
    {
        return QuestionResponseDto::collection($this->questionRepository->questions($questionSelectRequestDto));
    }

    public function questionById(int $id): QuestionResponseDto
    {
        return QuestionResponseDto::from($this->questionRepository->questionById($id));
    }

    public function store(QuestionRequestDto $requestDto): Question
    {
        $questionTranslationRequest = $requestDto->toArray()['translations'];
        $question = $this->questionRepository->store($requestDto);
        $question->translations()->createMany($questionTranslationRequest);
        return $question;
    }

    public function update(int $id, QuestionRequestDto $requestDto): Question
    {
        $question = $this->questionRepository->update($id, $requestDto);
        $this->updateTranslation($question, $requestDto);
        return $question;
    }

    public function updateTranslation(Question $question, QuestionRequestDto $requestDto): void
    {
        $questionTranslationRequest = $requestDto->toArray()['translations'];
        $question->translations()->delete();
        $question->translations()->createMany($questionTranslationRequest);
    }

    public function destroy(int $id): Question
    {
        return $this->questionRepository->destroy($id);
    }
}
