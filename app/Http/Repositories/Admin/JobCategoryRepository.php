<?php

namespace App\Http\Repositories\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\JobCategory\Request\JobCategoryRequestDto;
use App\Interfaces\Admin\JobCategory\JobCategoryRepositoryInterface;
use App\Models\JobCategory;
use App\Models\JobCategoryTranslation;
use App\Http\Enums\LanguageEnum;
use Illuminate\Support\Collection;

class JobCategoryRepository implements JobCategoryRepositoryInterface
{
    public function __construct(protected JobCategory $jobCategory)
    {
    }

    public function jobCategories(): Collection
    {
        return $this->jobCategory->with(['translations' => function ($query) {
            $query->select('id', 'job_category_id', 'language_id', 'name');
        }])
            ->select('id')
            ->get();
    }

    public function jobCategoryById(int $id): ?JobCategory
    {
        return $this->jobCategory->with(['translations' => function ($query) {
            $query->select('id', 'job_category_id', 'language_id', 'name');
        }])
            ->select('id')
            ->find($id);
    }

    public function store(): JobCategory
    {
        return $this->jobCategory->create();
    }

    public function update(int $id, JobCategoryRequestDto $request): JobCategory
    {
        $jobCategory = $this->jobCategory->find($id);
        if (!$jobCategory) {
            throw new NotFoundException('Kateqoriya tapılmadı');
        }
        $jobCategory->update($request->toArray());

        return $jobCategory;
    }

    public function updateTranslations(int $id, array $request): bool
    {
        return JobCategoryTranslation::where('id', $id)->update($request);
    }

    public function destroy(int $id): JobCategory
    {
        $jobCategory = $this->jobCategory->find($id);
        if (!$jobCategory) {
            throw new NotFoundException('Kateqoriya tapılmadı');
        }
        $jobCategory->delete();

        return $jobCategory;
    }
}
