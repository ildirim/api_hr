<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\DTOs\Admin\JobSubcategory\Request\JobSubcategoryRequestDto;
use App\Http\Requests\Admin\JobSubcategoryRequest;
use App\Interfaces\Admin\JobSubcategory\JobSubcategoryServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JobSubcategoryController extends Controller
{
    public function __construct(protected JobSubcategoryServiceInterface $jobSubcategoryService)
    {
    }

    public function jobSubcategories(): JsonResponse
    {
        $jobSubcategories = $this->jobSubcategoryService->jobSubcategories();
        return $this->success(Response::HTTP_OK, $jobSubcategories);
    }

    public function jobSubcategoriesByJobCategoryIdAndLocale(int $jobCategoryId, Request $request): JsonResponse
    {
        $jobSubcategories = $this->jobSubcategoryService->jobSubcategoriesByJobCategoryIdAndLocale($jobCategoryId, $request->header('lang'));
        return $this->success(Response::HTTP_OK, $jobSubcategories);
    }

    public function jobSubcategoryById(int $id): JsonResponse
    {
        $jobSubcategory = $this->jobSubcategoryService->jobSubcategoryById($id);
        return $this->success(Response::HTTP_OK, $jobSubcategory);
    }

    public function store(JobSubcategoryRequest $request): JsonResponse
    {
        $requestDto = JobSubcategoryRequestDto::fromRequest($request);
        $jobCategory = $this->jobSubcategoryService->store($requestDto);
        return $this->success(Response::HTTP_CREATED, $jobCategory);

    }

    public function update(int $id, JobSubcategoryRequest $request): JsonResponse
    {
        $requestDto = JobSubcategoryRequestDto::fromRequest($request);
        $result = $this->jobSubcategoryService->update($id, $requestDto);
        return $this->success(Response::HTTP_OK, $result);
    }

    public function destroy($id): JsonResponse
    {
        $result = $this->jobSubcategoryService->destroy($id);
        return $this->success(Response::HTTP_OK, $result);
    }
}
