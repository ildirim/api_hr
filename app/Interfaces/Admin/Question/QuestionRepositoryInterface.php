<?php

namespace App\Interfaces\Admin\Question;

use App\Http\DTOs\Admin\Question\Request\QuestionRequestDto;
use App\Http\DTOs\Admin\Question\Request\QuestionSelectRequestDto;
use App\Models\Question;
use Illuminate\Support\Collection;

interface QuestionRepositoryInterface
{
    public function questions(QuestionSelectRequestDto $questionSelectRequestDto): Collection;

    public function questionById(int $id): Question;

    public function store(QuestionRequestDto $request): Question;

    public function update(int $id, QuestionRequestDto $request): Question;

    public function destroy(int $id): Question;
}
