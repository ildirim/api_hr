<?php

namespace App\Interfaces\Admin\JobCategory;

use App\Http\DTOs\Admin\JobCategory\Request\JobCategoryRequestDto;
use App\Models\JobCategory;
use Illuminate\Support\Collection;

interface JobCategoryRepositoryInterface
{
    public function jobCategories(): Collection;

    public function jobCategoryById(int $id): JobCategory;

    public function store(): JobCategory;

    public function update(int $id, JobCategoryRequestDto $request): JobCategory;

    public function destroy(int $id): JobCategory;
}
