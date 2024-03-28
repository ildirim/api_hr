<?php

namespace App\Http\Repositories\Hr;

use App\Interfaces\Hr\JobCategory\JobCategoryRepositoryInterface;
use App\Models\JobCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class JobCategoryRepository implements JobCategoryRepositoryInterface
{
    public function __construct(protected JobCategory $jobCategory)
    {
    }

    public function jobCategories(string $lang): Collection
    {
        return $this->jobCategory
            ->select('q.id', 'q.period', 'q.question_level', 'qt.content')
            ->from('job_categories as jc')
            ->join('job_category_translations jct', 'jct.job_category_id', 'jc.id')
            ->where('jct.language_id', $lang)
            ->get();
    }
}
