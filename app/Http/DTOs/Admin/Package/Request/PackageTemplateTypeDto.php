<?php

namespace App\Http\DTOs\Admin\Package\Request;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Exists;

class PackageTemplateTypeDto extends Data
{
    public function __construct(
        #[Required]
        #[Exists('template_types', 'id')]
        public int $templateTypeId,

        #[Required]
        #[Min(1)]
        public int $count,

        #[Min(0)]
        public int $order = 0,
    ) {
    }
}
