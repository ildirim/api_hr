<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Interfaces\Hr\JobSubcategory\JobSubcategoryServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;

class JobSubcategoryController extends Controller
{
    use BaseResponse;

    public function __construct(protected JobSubcategoryServiceInterface $jobSubcategoryService)
    {
    }

    public function getJobSubcategoriesByCategoryId(int $jobCategoryId): JsonResponse
    {
        $subcategories = $this->jobSubcategoryService->getJobSubcategoriesByCategoryId($jobCategoryId);
        return $this->success($subcategories);
    }
}

