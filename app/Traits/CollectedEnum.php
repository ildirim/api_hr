<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait CollectedEnum
{
    final public static function caseValues(): array
    {
        return collect(self::cases())->pluck('value')->toArray();
    }

    final public static function caseNames(): array
    {
        return collect(self::cases())->pluck('name')->toArray();
    }

    final public static function collectCases(): Collection
    {
        return collect(self::cases());
    }
}
