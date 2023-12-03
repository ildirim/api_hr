<?php

namespace App\Interfaces\Admin\Answer;

use App\Http\DTOs\Admin\Answer\Request\AnswerRequestDto;
use App\Models\Answer;
use Illuminate\Http\Resources\Json\JsonResource;

interface AnswerServiceInterface
{
    public function answers(): JsonResource;

    public function answerById(int $id): JsonResource;

    public function store(AnswerRequestDto $request, ?int $questionId): Answer;

    public function update(int $id, AnswerRequestDto $request): Answer;

    public function destroy(int $id): JsonResource;
}
