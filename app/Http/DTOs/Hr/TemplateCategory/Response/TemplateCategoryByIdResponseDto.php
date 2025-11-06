<?php

namespace App\Http\DTOs\Hr\TemplateCategory\Response;

use App\Http\DTOs\Hr\TemplateQuestion\Response\TemplateQuestionResponseDto;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class TemplateCategoryByIdResponseDto extends Data
{
    public function __construct(
        public ?int $question_category_id,
        public ?string $question_category_name,
        public ?int $duration,
        public ?int $order_number,
        #[DataCollectionOf(TemplateQuestionResponseDto::class)]
        public DataCollection $questions,
    ) {
    }
}
