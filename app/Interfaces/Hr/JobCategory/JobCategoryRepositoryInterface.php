<?php

namespace App\Interfaces\Hr\JobCategory;

use Illuminate\Support\Collection;

interface JobCategoryRepositoryInterface
{
    public function getJobCategories(): Collection;
}
