<?php

namespace App\Http\Mappers\Admin\JobSubcategory;

use App\Http\DTOs\Admin\JobSubcategory\Request\JobSubcategoryRequestDto;
use App\Http\DTOs\Admin\JobSubcategory\Request\JobSubcategoryTranslationRequestDto;

class JobSubcategoryRequestMapper
{
    public static function requestToDto($request): JobSubcategoryRequestDto
    {
        $jobCategoryList = [];
        foreach ($request['translations'] as $translation) {
            $jobCategoryList[] = $translation;
        }
        return new JobSubcategoryRequestDto($request['jobCategoryId'], JobSubcategoryTranslationRequestDto::collection($jobCategoryList));
    }
}
