<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AnswerRequest;
use App\Interfaces\Admin\Answer\AnswerServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AnswerController extends Controller
{
    use BaseResponse;

    public function __construct(protected AnswerServiceInterface $answerService)
    {
    }

    public function answers(): JsonResponse
    {
        $answers = $this->answerService->answers();
        return $this->success($answers);
    }

    public function answerById(int $id): JsonResponse
    {
        $answer = $this->answerService->answerById($id);
        return $this->success(Response::HTTP_CREATED, $answer);
     }

    public function update(int $id, AnswerRequest $request): JsonResponse
    {
        $result = $this->answerService->update($id, $request);
        return $this->success($result);
    }

    public function destroy($id): JsonResponse
    {
        $result = $this->answerService->destroy($id);
        return $this->success($result);
    }
}
