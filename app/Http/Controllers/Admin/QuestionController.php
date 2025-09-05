<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\Question\Request\QuestionSelectRequestDto;
use App\Http\Requests\Admin\Question\QuestionSelectRequest;
use App\Http\Requests\Admin\QuestionRequest;
use App\Interfaces\Admin\Question\QuestionServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    use BaseResponse;

    public function __construct(protected QuestionServiceInterface $questionService)
    {
    }

    public function questions(QuestionSelectRequest $request): JsonResponse
    {
        $questionSelectRequestDto = QuestionSelectRequestDto::fromRequest($request);
        $questionCategories = $this->questionService->questions($questionSelectRequestDto);
        return $this->success($questionCategories);
    }

    public function shuffleQuestions(QuestionMixedRequest $request): JsonResponse
    {
        $questionMixedRequestDto = QuestionMixedRequestDto::fromRequest($request);
        $questionCategories = $this->questionService->questionsForSimpleTemplate($questionMixedRequestDto);
        return $this->success($questionCategories);
    }

    public function questionById(int $id): JsonResponse
    {
        $question = $this->questionService->questionById($id);
        return $this->success($question);
    }

    public function store(QuestionRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        $requestDto = QuestionRequestMapper::requestToDto($requestData);
        $question = $this->questionService->store($requestDto);
        return $this->success($question, 'Question created successfully', 'success', Response::HTTP_CREATED);
    }

    public function update(int $id, QuestionRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        $requestDto = QuestionRequestMapper::requestToDto($requestData);
        $result = $this->questionService->update($id, $requestDto);
        return $this->success($result);
    }

    public function destroy($id): JsonResponse
    {
        $result = $this->questionService->destroy($id);
        return $this->success($result);
    }
}
