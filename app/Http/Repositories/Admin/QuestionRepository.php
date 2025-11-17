<?php

namespace App\Http\Repositories\Admin;

use App\Exceptions\NotFoundException;
use App\Helpers\CommonHelper;
use App\Http\DTOs\Admin\Question\Request\QuestionRequestDto;
use App\Http\DTOs\Admin\Question\Request\QuestionSelectRequestDto;
use App\Interfaces\Admin\Question\QuestionRepositoryInterface;
use App\Models\Question;
use App\Models\QuestionTranslation;
use Illuminate\Support\Collection;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function __construct(protected Question $question)
    {
    }

    public function questions(QuestionSelectRequestDto $questionSelectRequestDto): Collection
    {

        $lang = CommonHelper::getLanguage();
        return $this->question->with([
            'translations' => function ($query) {
                $query->select('id', 'question_id', 'language_id', 'content');
            },
            'answers' => function ($query) {
                $query->select('id', 'question_id', 'is_correct')
                ->with(['translations' => function ($query) {
                    $query->select('id', 'answer_id', 'language_id', 'name');
                }]);
            }
        ])
            ->select('q.id', 'q.period', 'q.question_level', 'qct.name as question_category_name', 'jst.name as job_subcategory_name')
            ->from('questions as q')
            ->leftJoin('question_category_translations as qct', function ($join) use ($lang) {
                $join->on('qct.question_category_id', '=', 'q.question_category_id')
                    ->where('qct.language_id', '=', $lang);
            })
            ->leftJoin('job_subcategory_translations as jst', function ($join) use ($lang) {
                $join->on('jst.job_subcategory_id', '=', 'q.job_subcategory_id')
                    ->where('jst.language_id', '=', $lang);
            })
            ->questionCategory($questionSelectRequestDto->questionCategory)
            ->level($questionSelectRequestDto->questionLevel)
            ->jobSubcategory($questionSelectRequestDto->jobSubcategory)
            ->get();
    }

    public function questionById(int $id): ?Question
    {
        return $this->question->with([
            'translations' => function ($query) {
                $query->select('id', 'question_id', 'language_id', 'content');
            },
            'answers' => function ($query) {
                $query->select('id', 'question_id', 'is_correct')
                    ->with(['translations' => function ($query) {
                        $query->select('id', 'answer_id', 'language_id', 'name');
                    }]);
            }
        ])
            ->select('id', 'period', 'question_level')
            ->find($id);
    }

    public function store(QuestionRequestDto $request): Question
    {
        return $this->question->create($request->toArray());
    }

    public function update(int $id, QuestionRequestDto $request): Question
    {
        $question = $this->question->find($id);
        if (!$question) {
            throw new NotFoundException('Sual tapılmadı');
        }
        $question->update($request->toArray());

        return $question;
    }

    public function updateTranslations(int $id, array $request): bool
    {
        return QuestionTranslation::where('id', $id)->update($request);
    }

    public function destroy(int $id): Question
    {
        $question = $this->question->find($id);
        if (!$question) {
            throw new NotFoundException('Sual tapılmadı');
        }
        $question->delete();

        return $question;
    }
}
