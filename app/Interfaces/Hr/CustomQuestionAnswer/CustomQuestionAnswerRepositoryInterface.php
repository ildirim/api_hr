<?php

namespace App\Interfaces\Hr\CustomQuestionAnswer;

use App\Http\DTOs\Hr\CustomQuestion\Request\CustomQuestionRequestDto;
use App\Models\CustomQuestion;
use Illuminate\Support\Collection;

interface CustomQuestionAnswerRepositoryInterface
{
    public function customQuestions(): Collection;

    public function customQuestionById(int $id): CustomQuestion;

    public function store(CustomQuestionRequestDto $request): CustomQuestion;

    public function update(int $id, CustomQuestionRequestDto $request): CustomQuestion;

    public function destroy(int $id): CustomQuestion;
}
