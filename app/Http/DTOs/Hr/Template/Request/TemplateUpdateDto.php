<?php

namespace App\Http\DTOs\Hr\Template\Request;

use App\Http\DTOs\CoreData;
use Spatie\LaravelData\Attributes\Validation\DigitsBetween;

class TemplateUpdateDto extends CoreData
{
    public function __construct(
        #[DigitsBetween(7000, 8000)]
        public int $status,
    ) {
    }
}
