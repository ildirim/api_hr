<?php

namespace App\Http\Repositories\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\JobSubcategory\Request\JobSubcategoryRequestDto;
use App\Interfaces\Admin\JobSubcategory\JobSubcategoryRepositoryInterface;
use App\Models\JobSubcategory;
use App\Models\JobSubcategoryTranslation;
use App\Http\Enums\LanguageEnum;
use Illuminate\Support\Collection;

class JobSubcategoryRepository implements JobSubcategoryRepositoryInterface
{
    public function __construct(protected JobSubcategory $jobSubcategory)
    {
    }

    public function jobSubcategories(): Collection
    {
        return $this->jobSubcategory->with(['translations' => function ($query) {
            $query->select('id', 'job_subcategory_id', 'language_id', 'name');
        }])
            ->select('id', 'job_category_id')
            ->get();
    }

    public function jobSubcategoriesByJobCategoryIdAndLocale(int $jobCategoryId, ?string $locale): Collection
    {
        return $this->jobSubcategory->select('job_subcategories.id', 'jsct.id as job_subcategory_id', 'jsct.language_id', 'jsct.name')
            ->join('job_subcategory_translations as jsct', 'jsct.job_subcategory_id', 'job_subcategories.id')
            ->join('languages as l', 'l.id', 'jsct.language_id')
            ->where('job_subcategories.job_category_id', $jobCategoryId)
            ->where('l.locale', $locale ?? LanguageEnum::ENGLISH->value)
            ->get();
    }

    public function jobSubcategoryById(int $id): JobSubcategory
    {
        $jobSubcategory = $this->jobSubcategory->with(['translations' => function ($query) {
            $query->select('id', 'job_subcategory_id', 'language_id', 'name');
        }])
            ->select('id')
            ->find($id);
        if (!$jobSubcategory) {
            throw new NotFoundException('Alt kateqoriya tapılmadı');
        }
        return $jobSubcategory;
    }

    public function store(JobSubcategoryRequestDto $request): JobSubcategory
    {
        return $this->jobSubcategory->create($request->toArray());
    }

    public function update(int $id, JobSubcategoryRequestDto $request): JobSubcategory
    {
        $jobSubcategory = $this->jobSubcategory->find($id);
        if (!$jobSubcategory) {
            throw new NotFoundException('Alt kateqoriya tapılmadı');
        }
        $jobSubcategory->update($request->toArray());

        return $jobSubcategory;
    }

    public function updateTranslations(int $id, array $request): bool
    {
        return JobSubcategoryTranslation::where('id', $id)->update($request);
    }

    public function destroy(int $id): JobSubcategory
    {
        $jobSubcategory = $this->jobSubcategory->find($id);
        if (!$jobSubcategory) {
            throw new NotFoundException('Alt kateqoriya tapılmadı');
        }
        $jobSubcategory->delete();

        return $jobSubcategory;
    }
}
