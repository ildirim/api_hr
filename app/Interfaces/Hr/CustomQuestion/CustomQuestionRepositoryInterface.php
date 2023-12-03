<?php

namespace App\Interfaces\Hr\CustomQuestion;

use App\Http\DTOs\Hr\CustomQuestion\Request\CustomQuestionRequestDto;
use App\Models\CustomQuestion;

interface CustomQuestionRepositoryInterface
{
    public function store(CustomQuestionRequestDto $requestDto): CustomQuestion;

    public function update(int $id, CustomQuestionRequestDto $requestDto): CustomQuestion;
}
