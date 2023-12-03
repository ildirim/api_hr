<?php

namespace App\Interfaces\Hr\CustomAnswer;

use App\Http\DTOs\Hr\CustomAnswer\Request\CustomAnswerRequestDto;
use App\Models\CustomAnswer;

interface CustomAnswerServiceInterface
{
    public function store(CustomAnswerRequestDto $request, ?int $questionId): CustomAnswer;
}
