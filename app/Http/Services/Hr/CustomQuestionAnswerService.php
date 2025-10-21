<?php

namespace App\Http\Services\Hr;

use App\Http\DTOs\Hr\CustomQuestion\Request\CustomAnswerDto;
use App\Http\DTOs\Hr\CustomQuestion\Request\CustomQuestionRequestDto;
use App\Http\Requests\Hr\CustomQuestionAnswerRequest;
use App\Interfaces\Hr\CustomAnswer\CustomAnswerServiceInterface;
use App\Interfaces\Hr\CustomQuestion\CustomQuestionServiceInterface;
use App\Interfaces\Hr\CustomQuestionAnswer\CustomQuestionAnswerServiceInterface;
use App\Models\CustomQuestion;
use Illuminate\Support\Facades\DB;

class CustomQuestionAnswerService implements CustomQuestionAnswerServiceInterface
{
    public function __construct(
        protected CustomQuestionServiceInterface $customQuestionService,
        protected CustomAnswerServiceInterface   $customAnswerService,
    )
    {
    }

    public function store(CustomQuestionRequestDto $request): CustomQuestion
    {
        DB::beginTransaction();
        try {
            $customQuestion = $this->customQuestionService->store($request);
            $customQuestion->answers()->createMany(CustomAnswerDto::toLower($request->answers->toArray()));
            DB::commit();
            return $customQuestion;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function update(
        int $id,
        CustomQuestionRequestDto $request
    ): CustomQuestion
    {
        DB::beginTransaction();
        try {
            $customQuestion = $this->customQuestionService->update($id, $request);
            $customQuestion->answers()->delete();
            $customQuestion->answers()->createMany($request->answers->toArray());
            DB::commit();
            return $customQuestion;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }
}
