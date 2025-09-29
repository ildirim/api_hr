<?php

namespace App\Http\DTOs\Hr\Template\Request;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\ArrayType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class TemplateQuestionStoreDto extends Data
{
    public function __construct(
        #[ArrayType]
        public array $questionIds,
    ) {
    }

    public function messages(): array
    {
        return [
            'questionIds' => 'Suallar massiv tipi olmalıdır',
       ];
    }
}
