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
            $snakeKey = Str::snake($key);
            if (is_array($value)) {
                $normalized[$snakeKey] = self::toLower($value);
            } else {
                $normalized[$snakeKey] = $value;
            }
        }

        return $normalized;
    }
}
