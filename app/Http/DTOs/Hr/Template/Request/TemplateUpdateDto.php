<?php

namespace App\Http\DTOs\Hr\Template\Request;

use App\Http\DTOs\CoreData;
use Spatie\LaravelData\Attributes\Validation\Between;

class TemplateUpdateDto extends CoreData
{
    public function __construct(
        #[Between(7000, 8000)]
        public int $status,
    ) {
    }
}
