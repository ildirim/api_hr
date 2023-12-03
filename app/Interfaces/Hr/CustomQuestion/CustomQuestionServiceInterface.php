<?php

namespace App\Interfaces\Hr\CustomQuestion;

use App\Http\DTOs\Hr\CustomQuestion\Request\CustomQuestionRequestDto;
use App\Http\DTOs\Hr\CustomQuestion\Response\CustomQuestionResponseDto;
use App\Models\CustomQuestion;

interface CustomQuestionServiceInterface
{
    public function store(CustomQuestionRequestDto $request): CustomQuestion;

    public function customQuestionById(int $id): CustomQuestionResponseDto;
}
