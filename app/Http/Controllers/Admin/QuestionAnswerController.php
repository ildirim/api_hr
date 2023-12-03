<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Mappers\Admin\QuestionAnswer\QuestionAnswerRequestMapper;
use App\Http\Requests\Admin\QuestionAnswerRequest;
use App\Interfaces\Admin\QuestionAnswer\QuestionAnswerServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class QuestionAnswerController extends Controller
{
    public function __construct(protected QuestionAnswerServiceInterface $questionAnswerService)
    {
    }

    public function store(QuestionAnswerRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        $requestDto = QuestionAnswerRequestMapper::requestToDto($requestData);
        $question = $this->questionAnswerService->store($requestDto['questions'], $requestDto['answers']);
        return $this->success(Response::HTTP_CREATED, $question);
    }

    public function update(int $id, QuestionAnswerRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        $requestDto = QuestionAnswerRequestMapper::requestToDto($requestData);
        $result = $this->questionAnswerService->update($id, $requestDto['questions'], $requestDto['answers']);
        return $this->success(Response::HTTP_OK, $result);
    }
}
