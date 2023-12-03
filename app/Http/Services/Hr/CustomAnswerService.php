<?php

namespace App\Http\Services\Hr;

use App\Http\DTOs\Hr\CustomAnswer\Request\CustomAnswerRequestDto;
use App\Interfaces\Hr\CustomAnswer\CustomAnswerRepositoryInterface;
use App\Interfaces\Hr\CustomAnswer\CustomAnswerServiceInterface;
use App\Models\CustomAnswer;

class CustomAnswerService implements CustomAnswerServiceInterface
{
    public function __construct(protected CustomAnswerRepositoryInterface $customAnswerRepository)
    {
    }

    public function store(CustomAnswerRequestDto $requestDto, ?int $customQuestionId): CustomAnswer
    {
        return $this->customAnswerRepository->store($requestDto, $customQuestionId);
    }
}
