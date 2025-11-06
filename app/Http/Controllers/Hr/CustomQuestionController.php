<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Interfaces\Hr\CustomQuestion\CustomQuestionServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CustomQuestionController extends Controller
{
    use BaseResponse;

    public function __construct(protected CustomQuestionServiceInterface $customQuestionService)
    {
    }

    public function customQuestionsByTemplateId(int $templateId): JsonResponse
    {
        $customQuestions = $this->customQuestionService->customQuestionsByTemplateId($templateId);
        return $this->success($customQuestions);
    }

    public function customQuestionById(int $id): JsonResponse
    {
        $question = $this->customQuestionService->questionById($id);
        return $this->success($question);
    }
}
