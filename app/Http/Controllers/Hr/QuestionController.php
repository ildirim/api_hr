<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Hr\Question\Request\ShuffledQuestionDto;
use App\Interfaces\Hr\Question\QuestionServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;

class QuestionController extends Controller
{
    use BaseResponse;

    public function __construct(protected QuestionServiceInterface $questionService)
    {
    }

    public function getShuffledQuestions(ShuffledQuestionDto $shuffledQuestionDto): JsonResponse
    {
        $questionCategories = $this->questionService->getShuffledQuestions($shuffledQuestionDto);
        return $this->success($questionCategories);
    }
}
