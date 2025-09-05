<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Http\Mappers\Hr\CustomQuestionAnswer\CustomQuestionAnswerRequestMapper;
use App\Http\Requests\Hr\CustomQuestionAnswerRequest;
use App\Interfaces\Hr\CustomQuestionAnswer\CustomQuestionAnswerServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CustomQuestionAnswerController extends Controller
{
    use BaseResponse;

    public function __construct(protected CustomQuestionAnswerServiceInterface $customQuestionAnswerService)
    {
    }

    public function store(CustomQuestionAnswerRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        $requestDto = CustomQuestionAnswerRequestMapper::requestToDto($requestData);
        $question = $this->customQuestionAnswerService->store($requestDto['question'], $requestDto['answers']);
        return $this->success($question, 'Question created successfully', 'success', Response::HTTP_CREATED);
    }

    public function update(int $id, CustomQuestionAnswerRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        $requestDto = CustomQuestionAnswerRequestMapper::requestToDto($requestData);
        $result = $this->customQuestionAnswerService->update($id, $requestDto['question'], $requestDto['answers']);
        return $this->success($result);
    }
}
