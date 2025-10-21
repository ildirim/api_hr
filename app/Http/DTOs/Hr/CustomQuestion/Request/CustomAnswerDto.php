<?php

namespace App\Http\DTOs\Hr\CustomQuestion\Request;

use App\Http\DTOs\CoreData;
use Spatie\LaravelData\Attributes\Validation\DigitsBetween;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;

class CustomAnswerDto extends CoreData
{
    public function __construct(
        #[Required, IntegerType, DigitsBetween(1, 4)]
        public int $isCorrect,

        #[Required, Max(255)]
        public string $answerText
    ) {
    }
}
