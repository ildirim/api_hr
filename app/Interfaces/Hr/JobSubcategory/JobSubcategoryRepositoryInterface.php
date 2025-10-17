<?php

namespace App\Interfaces\Hr\JobSubcategory;

use Illuminate\Support\Collection;

interface JobSubcategoryRepositoryInterface
{
    public function getJobSubcategoriesByCategoryId(int $jobCategoryId): Collection;
}


