<?php

namespace App\Interfaces\Admin\Language;

use App\Http\DTOs\Admin\Language\Request\LanguageRequestDto;
use App\Models\Language;
use Illuminate\Support\Collection;

interface LanguageRepositoryInterface
{
    public function languages(): Collection;

    public function languageById(int $id): Language;

    public function store(LanguageRequestDto $request): Language;

    public function update(int $id, LanguageRequestDto $request): Language;

    public function destroy(int $id): Language;
}
