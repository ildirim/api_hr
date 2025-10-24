<?php

namespace App\Http\Services\Hr;

use App\Http\DTOs\Hr\JobSubcategory\Response\JobSubcategoryResponseDto;
use App\Interfaces\Hr\JobSubcategory\JobSubcategoryRepositoryInterface;
use App\Interfaces\Hr\JobSubcategory\JobSubcategoryServiceInterface;
use Spatie\LaravelData\DataCollection;

class JobSubcategoryService implements JobSubcategoryServiceInterface
{
    public function __construct(protected JobSubcategoryRepositoryInterface $jobSubcategoryRepository)
    {
    }

    public function getJobSubcategoriesByCategoryId(int $jobCategoryId): DataCollection
    {
        return JobSubcategoryResponseDto::collection(
            $this->jobSubcategoryRepository->getJobSubcategoriesByCategoryId($jobCategoryId)
        );
    }
}

