<?php

namespace App\Http\DTOs\Admin\Question\Request;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class QuestionRequestDto extends Data
{
    public function __construct(
        public int $jobSubcategoryId,
        public int $questionCategoryId,
        public int $questionLevel,
        public int $period,
        #[DataCollectionOf(QuestionTranslationRequestDto::class)]
        public DataCollection $translations,
    ) {
    }
}
