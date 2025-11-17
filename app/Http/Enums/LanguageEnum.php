<?php

namespace App\Http\Enums;

enum LanguageEnum: int
{
    case ENGLISH = 1;
    case AZERBAIJAN = 2;
    case RUSSIAN = 3;

    public static function getLabels(): array {
        return ['az', 'en', 'ru'];
    }

    public static function getLabelById(?int $id): ?string {
        return match ($id) {
            LanguageEnum::ENGLISH->value => 'en',
            LanguageEnum::AZERBAIJAN->value => 'az',
            LanguageEnum::RUSSIAN->value => 'ru',
            default => null
        };
    }

    public static function getIdByLabel(?string $label): ?string {
        return match ($label) {
            'en' => LanguageEnum::ENGLISH->value,
            'az' => LanguageEnum::AZERBAIJAN->value,
            'ru' => LanguageEnum::RUSSIAN->value,
            default => null
        };
    }
}
