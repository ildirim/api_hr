<?php

namespace App\Interfaces\Admin\QuestionCategory;

use App\Http\DTOs\Admin\QuestionCategory\Request\QuestionCategoryRequestDto;
use App\Models\QuestionCategory;
use Illuminate\Support\Collection;

interface QuestionCategoryRepositoryInterface
{
    public function questionCategories(): Collection;

    public function questionCategoryById(int $id): QuestionCategory;

    public function store(): QuestionCategory;

    public function update(int $id, QuestionCategoryRequestDto $request): QuestionCategory;

    public function destroy(int $id): QuestionCategory;
}
