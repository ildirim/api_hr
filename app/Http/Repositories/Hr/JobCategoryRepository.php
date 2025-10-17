<?php

namespace App\Http\Repositories\Hr;

use App\Helpers\CommonHelper;
use App\Interfaces\Hr\JobCategory\JobCategoryRepositoryInterface;
use App\Models\JobCategory;
use Illuminate\Support\Collection;

class JobCategoryRepository implements JobCategoryRepositoryInterface
{
    public function __construct(protected JobCategory $jobCategory)
    {
    }

    public function getJobCategories(): Collection
    {
        $language = CommonHelper::getLanguage();
        return $this->jobCategory
            ->select('jc.id', 'jct.name')
            ->from('job_categories as jc')
            ->join('job_category_translations as jct', 'jct.job_category_id', 'jc.id')
            ->where('jct.language_id', $language)
            ->get();
    }
}
