<?php

namespace App\Http\Services\Hr;

use App\Http\DTOs\Hr\Question\Request\ShuffledQuestionDto;
use App\Http\DTOs\Hr\Question\Response\QuestionResponseDto;
use App\Http\Enums\TemplateTypeEnum;
use App\Interfaces\Hr\Question\QuestionRepositoryInterface;
use App\Interfaces\Hr\Question\QuestionServiceInterface;
use App\Models\Admin;
use Spatie\LaravelData\DataCollection;

class QuestionService implements QuestionServiceInterface
{
    public function __construct(protected QuestionRepositoryInterface $questionRepository)
    {
    }

    public function getShuffledQuestions(ShuffledQuestionDto $shuffledQuestionDto): DataCollection
    {
        /** @var $admin Admin */
        $admin = auth('admin')->user();

        $shuffledQuestionDto->companyId = $admin->company_id;
        if ($shuffledQuestionDto->type === TemplateTypeEnum::FREE) {
            $questions = $this->questionRepository->getShuffledQuestions($shuffledQuestionDto);
        }
        return QuestionResponseDto::collection($questions);
    }
}
