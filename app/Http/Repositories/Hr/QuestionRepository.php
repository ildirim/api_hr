<?php

namespace App\Http\Repositories\Hr;

use App\Http\DTOs\Hr\Question\Request\QuestionMixedRequestDto;
use App\Interfaces\Hr\Question\QuestionRepositoryInterface;
use App\Models\Question;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function __construct(protected Question $question)
    {
    }

    public function questionsForSimpleTemplate(QuestionMixedRequestDto $requestDto): Collection
    {
        $request = $requestDto->toArray();
        return $this->question->with([
            'answers' => function ($query) use ($request) {
                $query->select('answers.id', 'answers.question_id', 'answers.is_correct', 'at.name')
                    ->join('answer_translations as at', 'at.answer_id', 'answers.id')
                    ->where('at.language_id', $request['language_id']);
            }
        ])
            ->select('q.id', 'q.period', 'q.question_level', 'qt.content')
            ->from('questions as q')
            ->join('question_translations as qt', 'qt.question_id', 'q.id')
            ->where('q.job_subcategory_id', $request['job_subcategory_id'])
            ->where('qt.language_id', $request['language_id'])
            ->whereNotExists(function ($query) use ($request) {
                $query->select(DB::raw(1))
                    ->from('template_category_questions as tcq')
                    ->where('tcq.question_id', '!=', 'q.id')
                    ->where('tcq.company_id', '!=', $request['company_id']);
            })
            ->inRandomOrder()
            ->limit(10)
            ->get();
    }
}
