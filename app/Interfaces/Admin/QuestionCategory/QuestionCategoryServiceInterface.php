<?php

namespace App\Interfaces\Admin\QuestionCategory;

use App\Http\DTOs\Admin\QuestionCategory\Request\QuestionCategoryRequestDto;
use App\Http\DTOs\Admin\QuestionCategory\Response\QuestionCategoryResponseDto;
use Spatie\LaravelData\DataCollection;

interface QuestionCategoryServiceInterface
{
    public function questionCategories(): DataCollection;

    public function questionCategoryById(int $id): QuestionCategoryResponseDto;

    public function store(QuestionCategoryRequestDto $request): QuestionCategoryResponseDto;

    public function update(int $id, QuestionCategoryRequestDto $request): QuestionCategoryResponseDto;

    public function destroy(int $id): QuestionCategoryResponseDto;
}
