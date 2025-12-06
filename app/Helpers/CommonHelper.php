\<?php

namespace App\Helpers;

use App\Http\Enums\LanguageEnum;

class CommonHelper
{
    public static function getLanguage(): string
    {
        return LanguageEnum::getIdByLabel(app()->getLocale());
    }

    public static function getLimit(): int
    {
        return request()->get('limit', 10);
    }
}
