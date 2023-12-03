<?php

namespace App\Http\Repositories\Hr;

use App\Http\DTOs\Hr\CustomAnswer\Request\CustomAnswerRequestDto;
use App\Interfaces\Hr\CustomAnswer\CustomAnswerRepositoryInterface;
use App\Models\CustomAnswer;

class CustomAnswerRepository implements CustomAnswerRepositoryInterface
{
    public function __construct(protected CustomAnswer $customAnswer)
    {
    }

    public function store(CustomAnswerRequestDto $requestDto, ?int $customQuestionId): CustomAnswer
    {
        $requestArray = $requestDto->toArray();
        $requestArray['custom_question_id'] = $customQuestionId;
        return $this->customAnswer->create($requestArray);
    }
}
