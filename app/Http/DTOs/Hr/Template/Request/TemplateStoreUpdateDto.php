<?php

namespace App\Http\DTOs\Hr\Template\Request;

use App\Http\DTOs\CoreData;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;

class TemplateStoreUpdateDto extends CoreData
{
    public function __construct(
        #[Exists('job_subcategories', 'id')]
        public int $jobSubcategoryId,

        #[Exists('template_types', 'id')]
        public int $templateTypeId,

        #[Exists('languages', 'id')]
        public int $languageId,

        #[Min(3)]
        #[Max(100)]
        public string $name,
    ) {
    }
}

