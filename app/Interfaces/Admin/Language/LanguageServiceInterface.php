<?php

namespace App\Interfaces\Admin\Language;

use App\Http\DTOs\Admin\Language\Request\LanguageRequestDto;
use App\Http\DTOs\Admin\Language\Response\LanguageResponseDto;
use Spatie\LaravelData\DataCollection;

interface LanguageServiceInterface
{
    public function languages(): DataCollection;

    public function languageById(int $id): LanguageResponseDto;

    public function store(LanguageRequestDto $request): LanguageResponseDto;

    public function update(int $id, LanguageRequestDto $request): LanguageResponseDto;

    public function destroy(int $id): LanguageResponseDto;
}
