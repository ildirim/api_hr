<?php

namespace App\Http\DTOs;

use Illuminate\Support\Str;
use Spatie\LaravelData\Data;

class CoreData extends Data
{
    public static function toLower(array $payload): array
    {
        $normalized = [];
        foreach ($payload as $key => $value) {
            $normalized[Str::snake($key)] = $value;
        }

        return $normalized;
    }
}
