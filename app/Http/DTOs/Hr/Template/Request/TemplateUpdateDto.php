<?php

namespace App\Http\DTOs\Hr\Template\Request;

use App\Http\DTOs\CoreData;
use App\Http\Enums\PassingTypeEnum;
use App\Http\Enums\TimingEnum;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Optional;

class TemplateUpdateDto extends CoreData
{
    public function __construct(
        #[Between(7000, 8000)]
        public int $status,
        #[Between(8000, 9000)]
        public int|Optional $passingTypeCode = PassingTypeEnum::CORRECT_ANSWERS_COUNT->value,
        #[Between(6000, 7000)]
        public int|Optional $timingCode = TimingEnum::TEMPLATE_BASE->value,
        #[Between(1, 1000)]
        public null|int|Optional $passingScore = 0,
        #[Between(1, 10000)]
        public null|int|Optional $duration = 0,
    ) {
    }
}
