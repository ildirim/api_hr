<?php

namespace App\Http\DTOs\Hr\TemplateQuestion\Response;

use App\Http\DTOs\Hr\Answer\Response\AnswerResponseDto;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class TemplateQuestionResponseDto extends Data
{
    public function __construct(
        public int $id,
        public string $period,
        public ?string $question_category_name,
        public ?string $job_subcategory_name,
        public ?string $content,
        #[DataCollectionOf(AnswerResponseDto::class)]
        public ?DataCollection $answers,
    ) {
    }
}




