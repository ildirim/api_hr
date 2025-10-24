<?php

namespace App\Interfaces\Hr\Question;

use App\Http\DTOs\Hr\Question\Request\ShuffledQuestionDto;
use Spatie\LaravelData\DataCollection;

interface QuestionServiceInterface
{
    public function getShuffledQuestions(ShuffledQuestionDto $shuffledQuestionDto): DataCollection;
}
