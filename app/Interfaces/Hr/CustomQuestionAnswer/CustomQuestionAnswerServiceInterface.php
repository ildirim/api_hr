<?php

namespace App\Interfaces\Hr\CustomQuestionAnswer;

use App\Http\DTOs\Hr\CustomQuestion\Request\CustomQuestionRequestDto;
use App\Models\CustomQuestion;

interface CustomQuestionAnswerServiceInterface
{
    public function store(
        CustomQuestionRequestDto $request
    ): CustomQuestion;

    public function update(
        int $id,
        CustomQuestionRequestDto $request,
    ): CustomQuestion;
}
