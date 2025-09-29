<?php

namespace App\Http\DTOs\Hr\Template\Request;

use App\Http\Enums\PassingTypeEnum;
use Illuminate\Support\Str;
use Spatie\LaravelData\Attributes\Validation\DigitsBetween;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class TemplateUpdateDto extends Data
{
    public function __construct(
        #[DigitsBetween(7000, 8000)]
        public int $status,
        #[DigitsBetween(8000, 9000)]
        public int|Optional $passingTypeCode = PassingTypeEnum::CORRECT_QUESTIONS_COUNT->value,
        #[DigitsBetween(1, 1000)]
        public int|Optional $passingScore,
        #[DigitsBetween(1, 10000)]
        public int|Optional $duration,
    ) {
    }

    public static function messages(): array
    {
        return [
            'passingTypeCode.required' => 'Passing type daxil edin',
            'passingTypeCode.digits_between' => 'Passing type kodu düzgün daxil edilməyib',
            'passingScore.integer' => 'Passing score rəqəm tipi olmalıdır',
            'passingScore.digits_between' => 'Passing score kodu düzgün daxil edilməyib',
            'name.required' => 'Şablon adı daxil edin',
            'duration.integer' => 'Müddət rəqəm tipi olmalıdır',
            'duration.DigitsBetween' => 'Müddət maksimal 10000 ola bilər',
        ];
    }


    public static function toLower(array $payload): array
    {
        $normalized = [];
        foreach ($payload as $key => $value) {
            $normalized[Str::snake($key)] = $value;
        }

        return $normalized;
    }
}
