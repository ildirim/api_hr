<?php

namespace App\Interfaces\Admin\JobCategory;

use App\Http\DTOs\Admin\JobCategory\Request\JobCategoryRequestDto;
use App\Http\DTOs\Admin\JobCategory\Response\JobCategoryResponseDto;
use Spatie\LaravelData\DataCollection;

interface JobCategoryServiceInterface
{
    public function jobCategories(): DataCollection;

    public function jobCategoryById(int $id): JobCategoryResponseDto;

    public function store(JobCategoryRequestDto $request): JobCategoryResponseDto;

    public function update(int $id, JobCategoryRequestDto $request): JobCategoryResponseDto;

    public function destroy(int $id): JobCategoryResponseDto;
}
