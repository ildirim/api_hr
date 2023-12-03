<?php

namespace App\Http\Repositories\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\Question\Request\QuestionMixedRequestDto;
use App\Http\DTOs\Admin\Question\Request\QuestionRequestDto;
use App\Http\DTOs\Admin\Question\Request\QuestionSelectRequestDto;
use App\Interfaces\Admin\Question\QuestionRepositoryInterface;
use App\Models\Question;
use App\Models\QuestionTranslation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function __construct(protected Question $question)
    {
    }

    public function questions(QuestionSelectRequestDto $questionSelectRequestDto): Collection
    {
        $request = $questionSelectRequestDto->toArray();
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
            ->questionCategory($request['questionCategory'])
            ->level($request['questionLevel'])
            ->jobSubcategory($request['jobSubcategory'])
            ->get();
    }

    public function questionById(int $id): Question
    {
        $question = $this->question->with([
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
        if (!$question) {
            throw new NotFoundException('Sual tapılmadı');
        }
        return $question;
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
