<?php

namespace App\Http\Mappers\Admin\JobCategory;

use App\Http\DTOs\Admin\JobCategory\Request\JobCategoryRequestDto;
use App\Http\DTOs\Admin\JobCategory\Request\JobCategoryTranslationRequestDto;

class JobCategoryRequestMapper
{
    public static function requestToDto($request): JobCategoryRequestDto
    {
        $jobCategoryList = [];
        foreach ($request['translations'] as $translation) {
            $jobCategoryList[] = $translation;
        }
        return new JobCategoryRequestDto(JobCategoryTranslationRequestDto::collection($jobCategoryList));
    }
}
