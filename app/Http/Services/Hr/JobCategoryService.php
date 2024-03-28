<?php

namespace App\Http\Services\Hr;

use App\Http\DTOs\Hr\JobCategory\Response\JobCategoryResponseDto;
use App\Interfaces\Hr\JobCategory\JobCategoryRepositoryInterface;
use App\Interfaces\Hr\JobCategory\JobCategoryServiceInterface;
use Spatie\LaravelData\DataCollection;

class JobCategoryService implements JobCategoryServiceInterface
{
    public function __construct(protected JobCategoryRepositoryInterface $questionRepository)
    {
    }

    public function jobCategories(string $lang): DataCollection
    {
        return JobCategoryResponseDto::collection($this->questionRepository->jobCategories($lang));
    }
}
