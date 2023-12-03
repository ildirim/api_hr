<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Hr\Question\Request\QuestionMixedRequestDto;
use App\Http\Requests\Hr\QuestionMixedRequest;
use App\Interfaces\Hr\Question\QuestionServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    public function __construct(protected QuestionServiceInterface $questionService)
    {
    }
    public function shuffleQuestions(QuestionMixedRequest $request): JsonResponse
    {
        $questionMixedRequestDto = QuestionMixedRequestDto::fromRequest($request);
        $questionCategories = $this->questionService->questionsForSimpleTemplate($questionMixedRequestDto);
        return $this->success(Response::HTTP_OK, $questionCategories);
    }
}
