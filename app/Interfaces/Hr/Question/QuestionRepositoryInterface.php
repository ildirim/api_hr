<?php

namespace App\Interfaces\Hr\Question;

use App\Http\DTOs\Hr\Question\Request\ShuffledQuestionDto;
use Illuminate\Support\Collection;

interface QuestionRepositoryInterface
{
    public function getShuffledQuestions(ShuffledQuestionDto $shuffledQuestionDto): Collection;
}
