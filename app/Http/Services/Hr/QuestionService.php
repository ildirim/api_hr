<?php

namespace App\Http\Services\Hr;

use App\Http\DTOs\Hr\Question\Request\QuestionMixedRequestDto;
use App\Http\DTOs\Hr\Question\Response\QuestionResponseDto;
use App\Interfaces\Hr\Question\QuestionRepositoryInterface;
use App\Interfaces\Hr\Question\QuestionServiceInterface;
use Spatie\LaravelData\DataCollection;

class QuestionService implements QuestionServiceInterface
{
    public function __construct(protected QuestionRepositoryInterface $questionRepository)
    {
    }

    public function questionsForSimpleTemplate(QuestionMixedRequestDto $request): DataCollection
    {
        return QuestionResponseDto::collection($this->questionRepository->questionsForSimpleTemplate($request));
    }
}
