<?php

namespace App\Interfaces\Hr\JobCategory;

use Spatie\LaravelData\DataCollection;

interface JobCategoryServiceInterface
{
    public function jobCategories(string $lang): DataCollection;
}
