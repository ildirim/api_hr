<?php

namespace App\Http\Repositories\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\Answer\Request\AnswerRequestDto;
use App\Interfaces\Admin\Answer\AnswerRepositoryInterface;
use App\Models\Answer;
use App\Models\AnswerTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerRepository implements AnswerRepositoryInterface
{
    public function __construct(protected Answer $answer)
    {
    }

    public function answers(): JsonResource
    {
        return $this->answer->get();
    }

    public function answerById(int $id): JsonResource
    {
        $answer = $this->answer->find($id);
        if (!$answer) {
            throw new NotFoundException('Sual tapılmadı');
        }
        return $answer;
    }

    public function store(AnswerRequestDto $request, ?int $questionId): Answer
    {
        $requestArray = $request->toArray();
        $requestArray['question_id'] = $questionId;
        return $this->answer->create($requestArray);
    }

    public function update(int $id, AnswerRequestDto $request): Answer
    {
        $answer = $this->answer->find($id);
        if (!$answer) {
            throw new NotFoundException('Sual tapılmadı');
        }
        $answer->update($request->toArray());

        return $answer;
    }

    public function updateTranslations(int $id, array $request): bool
    {
        return AnswerTranslation::where('id', $id)->update($request);
    }

    public function destroy(int $id): JsonResource
    {
        $answer = $this->answer->find($id);
        if (!$answer) {
            throw new NotFoundException('Sual tapılmadı');
        }
        $answer->delete();

        return $answer;
    }
}
