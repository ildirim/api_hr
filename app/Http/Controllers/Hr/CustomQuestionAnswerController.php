<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Hr\CustomQuestion\Request\CustomQuestionRequestDto;
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

    public function store(CustomQuestionRequestDto $request): JsonResponse
    {
        $questionAnswer = $this->customQuestionAnswerService->store($request);
        return $this->success($questionAnswer, 'Question created successfully', 'success', Response::HTTP_CREATED);
    }

    public function update(int $id, CustomQuestionRequestDto $request): JsonResponse
    {
        $result = $this->customQuestionAnswerService->update($id, $request);
        return $this->success($result);
    }
}
