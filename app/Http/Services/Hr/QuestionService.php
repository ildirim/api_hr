<?php

namespace App\Http\Services\Hr;

use App\Http\DTOs\Hr\Question\Request\ShuffledQuestionDto;
use App\Http\DTOs\Hr\Question\Response\QuestionResponseDto;
use App\Interfaces\Hr\Template\TemplateRepositoryInterface;
use App\Models\TemplateType;
use App\Interfaces\Hr\Question\QuestionRepositoryInterface;
use App\Interfaces\Hr\Question\QuestionServiceInterface;
use App\Models\Admin;
use Spatie\LaravelData\DataCollection;

class QuestionService implements QuestionServiceInterface
{
    public function __construct(
        protected QuestionRepositoryInterface $questionRepository,
        protected TemplateRepositoryInterface $templateRepository,
    )
    {
    }

    public function getShuffledQuestions(ShuffledQuestionDto $shuffledQuestionDto): DataCollection
    {
        /** @var $admin Admin */
        $admin = auth('admin')->user();

        $shuffledQuestionDto->companyId = $admin->company_id;

        $templateType = $this->templateRepository->getTemplateTypeByTemplateId($shuffledQuestionDto->templateId);
        if (!$templateType || !$templateType->has_shuffle_questions) {
            return QuestionResponseDto::collection(collect());
        }
        $shuffledQuestionDto->questionsCount = $shuffledQuestionDto->questionsCount ?? $templateType->max_shuffled_question_count;
        $questions = $this->questionRepository->getShuffledQuestions($shuffledQuestionDto);
        return QuestionResponseDto::collection($questions);
    }
}
