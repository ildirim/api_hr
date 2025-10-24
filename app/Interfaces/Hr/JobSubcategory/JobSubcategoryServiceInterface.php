<?php

namespace App\Interfaces\Hr\JobSubcategory;

use App\Http\DTOs\Hr\JobSubcategory\Response\JobSubcategoryResponseDto;
use Spatie\LaravelData\DataCollection;

interface JobSubcategoryServiceInterface
{
    public function getJobSubcategoriesByCategoryId(int $jobCategoryId): DataCollection;
}

