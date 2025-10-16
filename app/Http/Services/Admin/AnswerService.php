<?php

namespace App\Http\Services\Admin;

use App\Http\DTOs\Admin\Answer\Request\AnswerRequestDto;
use App\Http\Requests\Admin\AnswerRequest;
use App\Http\Resources\Admin\AnswerResource;
use App\Interfaces\Admin\Answer\AnswerRepositoryInterface;
use App\Interfaces\Admin\Answer\AnswerServiceInterface;
use App\Models\Answer;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class AnswerService implements AnswerServiceInterface
{
    public function __construct(protected AnswerRepositoryInterface $answerRepository)
    {
    }

    public function answers(): JsonResource
    {
        return $this->answerRepository->answers();
    }

    public function answerById(int $id): JsonResource
    {
        return $this->answerRepository->answerById($id);
    }

    public function store(AnswerRequestDto $request, ?int $questionId): Answer
    {
        $answerTranslationRequest = $request->toArray()['translations'];
        $answer = $this->answerRepository->store($request, $questionId);
        $answer->translations()->createMany($answerTranslationRequest);
        return $answer;
    }

    public function update(int $id, AnswerRequestDto $requestDto): Answer
    {
        $answer = $this->answerRepository->update($id, $requestDto);
        $this->updateTranslation($answer, $requestDto);
        return $answer;
    }

    public function updateTranslation(Answer $answer, AnswerRequestDto $request): void
    {
        $answerTranslationRequest = $request->toArray()['translations'];
        $answer->translations()->delete();
        $answer->translations()->createMany($answerTranslationRequest);
    }

    public function destroy(int $id): JsonResource
    {
        return $this->answerRepository->destroy($id);
    }
}
