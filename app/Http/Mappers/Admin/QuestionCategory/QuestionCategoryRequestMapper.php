<?php

namespace App\Http\Mappers\Admin\QuestionCategory;

use App\Http\DTOs\Admin\QuestionCategory\Request\QuestionCategoryRequestDto;
use App\Http\DTOs\Admin\QuestionCategory\Request\QuestionCategoryTranslationRequestDto;

class QuestionCategoryRequestMapper
{
    public static function requestToDto($request): QuestionCategoryRequestDto
    {
        $questionCategoryList = [];
        foreach ($request['translations'] as $translation) {
            $questionCategoryList[] = $translation;
        }
        return new QuestionCategoryRequestDto(QuestionCategoryTranslationRequestDto::collection($questionCategoryList));
    }
}
