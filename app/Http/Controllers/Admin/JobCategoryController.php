<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\DTOs\Admin\JobCategory\Request\JobCategoryRequestDto;
use App\Http\Requests\Admin\JobCategoryRequest;
use App\Interfaces\Admin\JobCategory\JobCategoryServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JobCategoryController extends Controller
{
    public function __construct(protected JobCategoryServiceInterface $jobCategoryService)
    {
    }

    public function jobCategories(): JsonResponse
    {
        $jobCategories = $this->jobCategoryService->jobCategories();
        return $this->success(Response::HTTP_OK, $jobCategories);
    }

    public function jobCategoriesByLocale(Request $request): JsonResponse
    {
        $jobCategories = $this->jobCategoryService->jobCategoriesByLocale($request->header('lang'));
        return $this->success(Response::HTTP_OK, $jobCategories);
    }

    public function jobCategoryById(int $id): JsonResponse
    {
        $jobCategory = $this->jobCategoryService->jobCategoryById($id);
        return $this->success(Response::HTTP_OK, $jobCategory);
    }

    public function store(JobCategoryRequest $request): JsonResponse
    {
        $jobCategoryRequestDto = JobCategoryRequestDto::fromRequest($request);
        $jobCategory = $this->jobCategoryService->store($jobCategoryRequestDto);
        return $this->success(Response::HTTP_CREATED, $jobCategory);
    }

    public function update(int $id, JobCategoryRequest $request): JsonResponse
    {
        $jobCategoryRequestDto = JobCategoryRequestDto::fromRequest($request);
        $result = $this->jobCategoryService->update($id, $jobCategoryRequestDto);
        return $this->success(Response::HTTP_OK, $result);
    }

    public function destroy($id): JsonResponse
    {
        $result = $this->jobCategoryService->destroy($id);
        return $this->success(Response::HTTP_OK, $result);
    }
}
