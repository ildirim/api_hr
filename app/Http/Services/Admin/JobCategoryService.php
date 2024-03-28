<?php

namespace App\Http\Services\Admin;

use App\Http\DTOs\Admin\JobCategory\Request\JobCategoryRequestDto;
use App\Http\DTOs\Admin\JobCategory\Response\JobCategoryResponseDto;
use App\Http\DTOs\Admin\JobCategory\Response\JobCategoryByLocaleResponseDto;
use App\Interfaces\Admin\JobCategory\JobCategoryRepositoryInterface;
use App\Interfaces\Admin\JobCategory\JobCategoryServiceInterface;
use App\Models\JobCategory;
use App\Models\JobCategoryTranslation;
use Spatie\LaravelData\DataCollection;

class JobCategoryService implements JobCategoryServiceInterface
{
    public function __construct(protected JobCategoryRepositoryInterface $jobCategoryRepository)
    {
    }

    public function jobCategories(): DataCollection
    {
        return JobCategoryResponseDto::collection($this->jobCategoryRepository->jobCategories());
    }

    public function jobCategoriesByLocale(?string $locale): DataCollection
    {
        return JobCategoryByLocaleResponseDto::collection($this->jobCategoryRepository->jobCategoriesByLocale($locale));
    }

    public function jobCategoryById(int $id): JobCategoryResponseDto
    {
        return JobCategoryResponseDto::from($this->jobCategoryRepository->jobCategoryById($id));
    }

    public function store(JobCategoryRequestDto $request): JobCategoryResponseDto
    {
        $jobCategoryTranslationRequest = $request->toArray()['translations'];
        $jobCategory = $this->jobCategoryRepository->store();
        $jobCategory->translations()->createMany($jobCategoryTranslationRequest);
        return JobCategoryResponseDto::from($jobCategory);
    }

    public function update(int $id, JobCategoryRequestDto $request): JobCategoryResponseDto
    {
        $jobCategory = $this->jobCategoryRepository->update($id, $request);
        $this->updateTranslation($jobCategory, $request);
        return JobCategoryResponseDto::from($jobCategory);
    }

    public function updateTranslation(JobCategory $jobCategory, JobCategoryRequestDto $request): void
    {
        $jobCategoryTranslationRequest = $request->toArray()['translations'];
        foreach ($jobCategoryTranslationRequest as $jobCategoryTranslation) {
            if (isset($jobCategoryTranslation['id'])) {
                $this->jobCategoryRepository->updateTranslations($jobCategoryTranslation['id'], $jobCategoryTranslation);
            } else {
                $jobCategory->translations()->create($jobCategoryTranslation);
            }
        }
    }

    public function destroy(int $id): JobCategoryResponseDto
    {
        return JobCategoryResponseDto::from($this->jobCategoryRepository->destroy($id));
    }
}
