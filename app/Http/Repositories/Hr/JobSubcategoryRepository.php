<?php

namespace App\Http\Repositories\Hr;

use App\Helpers\CommonHelper;
use App\Interfaces\Hr\JobSubcategory\JobSubcategoryRepositoryInterface;
use App\Models\JobSubcategory;
use Illuminate\Support\Collection;

class JobSubcategoryRepository implements JobSubcategoryRepositoryInterface
{
    public function __construct(protected JobSubcategory $jobSubcategory)
    {
    }

    public function getJobSubcategoriesByCategoryId(int $jobCategoryId): Collection
    {
        $language = CommonHelper::getLanguage();
        return $this->jobSubcategory
            ->select('jsc.id', 'jsct.name')
            ->from('job_subcategories as jsc')
            ->join('job_subcategory_translations as jsct', 'jsct.job_subcategory_id', 'jsc.id')
            ->where('jsc.job_category_id', $jobCategoryId)
            ->where('jsct.language_id', $language)
            ->get();
    }
}

