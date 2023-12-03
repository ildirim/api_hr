<?php

namespace App\Interfaces\Admin\JobSubcategory;

use App\Http\DTOs\Admin\JobSubcategory\Request\JobSubcategoryRequestDto;
use App\Http\DTOs\Admin\JobSubcategory\Response\JobSubcategoryResponseDto;
use Spatie\LaravelData\DataCollection;

interface JobSubcategoryServiceInterface
{
    public function jobSubcategories(): DataCollection;

    public function jobSubcategoryById(int $id): JobSubcategoryResponseDto;

    public function store(JobSubcategoryRequestDto $request): JobSubcategoryResponseDto;

    public function update(int $id, JobSubcategoryRequestDto $request): JobSubcategoryResponseDto;

    public function destroy(int $id): JobSubcategoryResponseDto;
}
