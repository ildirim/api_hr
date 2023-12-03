<?php

namespace App\Interfaces\Admin\QuestionAnswer;

use App\Http\DTOs\Admin\Question\Request\QuestionRequestDto;

interface QuestionAnswerServiceInterface
{
    public function store(
        QuestionRequestDto $questionRequestDto,
        array $listOfAnswers,
    ): bool;

    public function update(
        int $id,
        QuestionRequestDto $request,
        array $listOfAnswers,
    ): bool;
}
