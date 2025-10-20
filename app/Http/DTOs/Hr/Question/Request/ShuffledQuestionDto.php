<?php

namespace App\Http\DTOs\Hr\Question\Request;

use App\Helpers\CommonHelper;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

class ShuffledQuestionDto extends Data
{
    #[Computed]
    public null|int $companyId;

    #[Computed]
    public int $languageId;

    public function __construct(
        public null|int $questionsCount = null,
        #[Exists('templates', 'id')]
        public int $templateId,
    ) {
        $this->languageId = CommonHelper::getLanguage();
    }
}
