<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Interfaces\Hr\CustomQuestion\CustomQuestionServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CustomQuestionController extends Controller
{
    public function __construct(protected CustomQuestionServiceInterface $customQuestionService)
    {
    }

    public function customQuestionsByTemplateCategoryId(int $templateCategoryId): JsonResponse
    {
        $customQuestions = $this->customQuestionService->customQuestionsByTemplateCategoryId($templateCategoryId);
        return $this->success(Response::HTTP_OK, $customQuestions);
    }

    public function customQuestionById(int $id): JsonResponse
    {
        $question = $this->customQuestionService->questionById($id);
        return $this->success(Response::HTTP_OK, $question);
    }
}
