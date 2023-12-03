<?php

namespace App\Http\Services\Admin;

use App\Http\DTOs\Admin\Question\Request\QuestionRequestDto;
use App\Interfaces\Admin\Answer\AnswerServiceInterface;
use App\Interfaces\Admin\Question\QuestionServiceInterface;
use App\Interfaces\Admin\QuestionAnswer\QuestionAnswerServiceInterface;
use Illuminate\Support\Facades\DB;

class QuestionAnswerService implements QuestionAnswerServiceInterface
{
    public function __construct(
        protected QuestionServiceInterface $questionService,
        protected AnswerServiceInterface   $answerService,
    )
    {
    }

    public function store(QuestionRequestDto $questionRequestDto, array $listOfAnswers): bool
    {
        DB::beginTransaction();
        try {
            $question = $this->questionService->store($questionRequestDto);
            foreach ($listOfAnswers as $answerDto) {
                $this->answerService->store($answerDto, $question->id);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function update(
        int $id,
        QuestionRequestDto $questionRequestDto,
        array $listOfAnswers,
    ): bool
    {
        DB::beginTransaction();
        try {
            $question = $this->questionService->update($id, $questionRequestDto);
            $question->answers()->delete();
            foreach ($listOfAnswers as $answerDto) {
                $this->answerService->store($answerDto, $question->id);
            }
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }
}
