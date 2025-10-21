<?php

namespace App\Http\DTOs\Hr\CustomQuestion\Request;

use App\Http\DTOs\CoreData;
use App\Http\Enums\QuestionTypeEnum;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\DataCollection;

class CustomQuestionRequestDto extends CoreData
{
    #[Computed]
    public ?int $adminId = null;

    #[Computed]
    public ?int $companyId = null;

    public int $type = QuestionTypeEnum::SINGLE_CHOICE->value;

    public function __construct(
        #[Required, IntegerType, Between(1, 11), Exists('templates', 'id')]
        public int $templateId,

        #[Required, Numeric, Exists('languages', 'id')]
        public int $languageId,

        #[Required, Max(2000)]
        public string $content,

        #[DataCollectionOf(CustomAnswerDto::class)]
        public DataCollection $answers,
    ) {
        $admin = auth('admin')->user();
        $this->adminId = $admin->id;
        $this->companyId = $admin->company_id;
    }
}
