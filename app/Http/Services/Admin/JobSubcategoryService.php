<?php

namespace App\Http\Services\Admin;

use App\Http\DTOs\Admin\JobSubcategory\Request\JobSubcategoryRequestDto;
use App\Http\DTOs\Admin\JobSubcategory\Response\JobSubcategoryResponseDto;
use App\Http\DTOs\Admin\JobSubcategory\Response\JobSubcategoryByLocaleResponseDto;
use App\Interfaces\Admin\JobSubcategory\JobSubcategoryRepositoryInterface;
use App\Interfaces\Admin\JobSubcategory\JobSubcategoryServiceInterface;
use App\Models\JobCategoryTranslation;
use App\Models\JobSubcategory;
use Spatie\LaravelData\DataCollection;

class JobSubcategoryService implements JobSubcategoryServiceInterface
{
    public function __construct(protected JobSubcategoryRepositoryInterface $jobSubcategoryRepository)
    {
    }

    public function jobSubcategories(): DataCollection
    {
        return JobSubcategoryResponseDto::collection($this->jobSubcategoryRepository->jobSubcategories());
    }

    public function jobSubcategoriesByJobCategoryIdAndLocale(int $jobCategoryId, ?string $locale): DataCollection
    {
        return JobSubcategoryByLocaleResponseDto::collection(
            $this->jobSubcategoryRepository->jobSubcategoriesByJobCategoryIdAndLocale($jobCategoryId, $locale)
        );
    }

    public function jobSubcategoryById(int $id): JobSubcategoryResponseDto
    {
        return JobSubcategoryResponseDto::from($this->jobSubcategoryRepository->jobSubcategoryById($id));
    }

    public function store(JobSubcategoryRequestDto $request): JobSubcategoryResponseDto
    {
        $jobSubcategoryTranslationRequest = $request->toArray()['translations'];
        $jobSubcategory = $this->jobSubcategoryRepository->store($request);
        $jobSubcategory->translations()->createMany($jobSubcategoryTranslationRequest);
        return JobSubcategoryResponseDto::from($jobSubcategory);
    }

    public function update(int $id, JobSubcategoryRequestDto $request): JobSubcategoryResponseDto
    {
        $jobSubcategory = $this->jobSubcategoryRepository->update($id, $request);
        $this->updateTranslation($jobSubcategory, $request);
        return JobSubcategoryResponseDto::from($jobSubcategory);
    }

    public function updateTranslation(JobSubcategory $jobSubcategory, JobSubcategoryRequestDto $request): void
    {
        $jobSubcategoryTranslationRequest = $request->toArray()['translations'];
        $jobSubcategory->translations()->delete();
        $jobSubcategory->translations()->createMany($jobSubcategoryTranslationRequest);
    }

    public function destroy(int $id): JobSubcategoryResponseDto
    {
        return JobSubcategoryResponseDto::from($this->jobSubcategoryRepository->destroy($id));
    }
}
