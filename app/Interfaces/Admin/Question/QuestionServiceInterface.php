<?php

namespace App\Interfaces\Admin\Question;

use App\Http\DTOs\Admin\Question\Request\QuestionRequestDto;
use App\Http\DTOs\Admin\Question\Request\QuestionSelectRequestDto;
use App\Http\DTOs\Admin\Question\Response\QuestionResponseDto;
use App\Models\Question;
use Spatie\LaravelData\DataCollection;

interface QuestionServiceInterface
{
    public function questions(QuestionSelectRequestDto $questionSelectRequestDto): DataCollection;

    public function questionById(int $id): QuestionResponseDto;

    public function store(QuestionRequestDto $requestDto): Question;

    public function update(int $id, QuestionRequestDto $requestDto): Question;

    public function destroy(int $id): Question;
}
