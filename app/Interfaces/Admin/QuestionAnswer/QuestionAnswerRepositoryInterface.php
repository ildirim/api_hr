<?php

namespace App\Interfaces\Admin\Question;

use App\Http\Requests\Admin\QuestionRequest;
use App\Models\Question;
use Illuminate\Http\Resources\Json\JsonResource;

interface QuestionAnswerRepositoryInterface
{
    public function questions(array $params): JsonResource;

    public function questionById(int $id): JsonResource;

    public function store(QuestionRequest $request): JsonResource;

    public function update(int $id, QuestionRequest $request): Question;

    public function destroy(int $id): JsonResource;
}
