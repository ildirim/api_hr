<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Http\Enums\LanguageEnum;
use App\Interfaces\Hr\JobCategory\JobCategoryServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JobCategoryController extends Controller
{
    use BaseResponse;

    public function __construct(protected JobCategoryServiceInterface $jobCategoryService)
    {
    }

    public function jobCategories(Request $request): JsonResponse
    {
        $lang = $request->getPreferredLanguage() ?? LanguageEnum::ENGLISH->value;
        $jobCategories = $this->jobCategoryService->jobCategories($lang);
        return $this->success($jobCategories);
    }

    public function jobCategoryById(int $id): JsonResponse
    {
        $jobCategory = $this->jobCategoryService->jobCategoryById($id);
        return $this->success($jobCategory);
    }
}
