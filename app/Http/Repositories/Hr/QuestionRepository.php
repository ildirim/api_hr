<?php

namespace App\Http\Repositories\Hr;

use App\Http\DTOs\Hr\Question\Request\ShuffledQuestionDto;
use App\Interfaces\Hr\Question\QuestionRepositoryInterface;
use App\Models\Question;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function __construct(protected Question $question)
    {
    }

    public function getShuffledQuestions(ShuffledQuestionDto $shuffledQuestionDto): ?LengthAwarePaginator
    {
        return $this->question->with([
            'answers' => function ($query) use ($shuffledQuestionDto) {
                $query->select('answers.id', 'answers.question_id', 'answers.is_correct', 'at.name')
                    ->join('answer_translations as at', 'at.answer_id', 'answers.id')
                    ->where('at.language_id', $shuffledQuestionDto->languageId);
            }
        ])
            ->select('q.id', 'q.period', 'q.question_level', 'qt.content')
            ->from('questions as q')
            ->join('question_translations as qt', 'qt.question_id', 'q.id')
            ->where('q.job_subcategory_id', $shuffledQuestionDto->jobSubcategoryId)
            ->where('qt.language_id', $shuffledQuestionDto->languageId)
            ->whereNotExists(function ($query) use ($shuffledQuestionDto) {
                $query->select(DB::raw(1))
                    ->from('template_category_questions as tcq')
                    ->where('tcq.question_id', '!=', 'q.id')
                    ->where('tcq.company_id', '!=', $shuffledQuestionDto->companyId);
            })
            ->inRandomOrder()
            ->paginate();
    }
}
