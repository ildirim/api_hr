<?php

namespace App\Helpers;

use App\Http\Enums\LanguageEnum;

class CommonHelper
{
    public static function getLanguage(): string
    {
            return request()->get('Accept-Language')
                ?? LanguageEnum::getLabelById(LanguageEnum::ENGLISH->value);
    }
}
