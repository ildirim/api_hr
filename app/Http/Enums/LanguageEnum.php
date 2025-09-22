<?php

namespace App\Http\Enums;

enum LanguageEnum: int
{
    case ENGLISH = 1;
    case AZERBAIJAN = 2;
    case RUSSIAN = 3;

    public static function getLabelById(?int $id): ?string {
        return match ($id) {
            LanguageEnum::ENGLISH->value => 'en',
            LanguageEnum::AZERBAIJAN->value => 'az',
            LanguageEnum::RUSSIAN->value => 'ru',
            default => null
        };
    }
}
