<?php

namespace App\Interfaces\Admin\JobSubcategory;

use App\Http\DTOs\Admin\JobSubcategory\Request\JobSubcategoryRequestDto;
use App\Models\JobSubcategory;
use Illuminate\Support\Collection;

interface JobSubcategoryRepositoryInterface
{
    public function jobSubcategories(): Collection;

    public function jobSubcategoryById(int $id): JobSubcategory;

    public function store(JobSubcategoryRequestDto $request): JobSubcategory;

    public function update(int $id, JobSubcategoryRequestDto $request): JobSubcategory;

    public function destroy(int $id): JobSubcategory;
}
