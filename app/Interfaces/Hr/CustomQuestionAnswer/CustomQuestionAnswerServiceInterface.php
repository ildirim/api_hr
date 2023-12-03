<?php

namespace App\Interfaces\Hr\CustomQuestionAnswer;

use App\Http\DTOs\Hr\CustomQuestion\Request\CustomQuestionRequestDto;
use App\Http\DTOs\Hr\CustomQuestion\Response\CustomQuestionResponseDto;

interface CustomQuestionAnswerServiceInterface
{
    public function store(
        CustomQuestionRequestDto $requestDto,
        array $customAnswers,
    ): int;

    public function update(
        int $id,
        CustomQuestionRequestDto $requestDto,
        array $customAnswers,
    ): bool;
}
