<?php

namespace App\Http\DTOs\Hr\Template\Request;

use App\Http\Enums\TemplateStatusEnum;
use Illuminate\Support\Str;
use Spatie\LaravelData\Attributes\Validation\ArrayType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class TemplateQuestionDto extends Data
{
    public int $status = TemplateStatusEnum::INCOMPLETED_STEP2->value;

    public function __construct(
        #[ArrayType]
        public array $questionIds,
        public null|int|Optional $questionCategoryId = null,
        public int|Optional $orderNumber = 0,
    ) {
    }

    public static function messages(): array
    {
        return [
            'questionIds.required' => 'Suallar daxil edilməyib',
            'questionIds.array_type' => 'Suallar daxil edilməyib',
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
