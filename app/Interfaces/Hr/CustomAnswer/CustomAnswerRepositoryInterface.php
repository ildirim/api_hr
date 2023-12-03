<?php

namespace App\Interfaces\Hr\CustomAnswer;

use App\Http\DTOs\Hr\CustomAnswer\Request\CustomAnswerRequestDto;
use App\Models\CustomAnswer;

interface CustomAnswerRepositoryInterface
{
    public function store(CustomAnswerRequestDto $request, ?int $customQuestionId): CustomAnswer;
}
