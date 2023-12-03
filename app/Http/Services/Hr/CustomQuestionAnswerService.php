<?php

namespace App\Http\Services\Hr;

use App\Http\DTOs\Hr\CustomQuestion\Request\CustomQuestionRequestDto;
use App\Interfaces\Hr\CustomAnswer\CustomAnswerServiceInterface;
use App\Interfaces\Hr\CustomQuestion\CustomQuestionServiceInterface;
use App\Interfaces\Hr\CustomQuestionAnswer\CustomQuestionAnswerServiceInterface;
use Illuminate\Support\Facades\DB;

class CustomQuestionAnswerService implements CustomQuestionAnswerServiceInterface
{
    public function __construct(
        protected CustomQuestionServiceInterface $customQuestionService,
        protected CustomAnswerServiceInterface   $customAnswerService,
    )
    {
    }

    public function store(CustomQuestionRequestDto $requestDto, array $customAnswers): int
    {
        DB::beginTransaction();
        try {
            $customQuestion = $this->customQuestionService->store($requestDto);
            foreach ($customAnswers as $answerDto) {
                $this->customAnswerService->store($answerDto, $customQuestion->id);
            }
            DB::commit();
            return $customQuestion->id;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function update(
        int $id,
        CustomQuestionRequestDto $requestDto,
        array $customAnswers,
    ): bool
    {
        DB::beginTransaction();
        try {
            $customQuestion = $this->customQuestionService->update($id, $requestDto);
            $customQuestion->answers()->delete();
            foreach ($customAnswers as $answerDto) {
                $this->customAnswerService->store($answerDto, $customQuestion->id);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }
}
