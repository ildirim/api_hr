<?php

namespace App\Http\Services\Admin;

use App\Http\DTOs\Admin\Language\Request\LanguageRequestDto;
use App\Http\DTOs\Admin\Language\Response\LanguageResponseDto;
use App\Http\Requests\Admin\LanguageRequest;
use App\Interfaces\Admin\Language\LanguageRepositoryInterface;
use App\Interfaces\Admin\Language\LanguageServiceInterface;
use Illuminate\Support\Facades\Cache;
use Spatie\LaravelData\DataCollection;

class LanguageService implements LanguageServiceInterface
{
    public function __construct(protected LanguageRepositoryInterface $languageRepository)
    {
    }

    public function languages(): DataCollection
    {
        $languages = Cache::get('languages');
        if (!$languages) {
            $languages = $this->languageRepository->languages();
            Cache::put('languages', $languages);
        }
        return LanguageResponseDto::collection($this->languageRepository->languages());
    }

    public function languageById(int $id): LanguageResponseDto
    {
        return LanguageResponseDto::from($this->languageRepository->languageById($id));
    }

    public function store(LanguageRequestDto $request): LanguageResponseDto
    {
        return LanguageResponseDto::from($this->languageRepository->store($request));
    }

    public function update(int $id, LanguageRequestDto $request): LanguageResponseDto
    {
        return LanguageResponseDto::from($this->languageRepository->update($id, $request));
    }

    public function destroy(int $id): LanguageResponseDto
    {
        return LanguageResponseDto::from($this->languageRepository->destroy($id));
    }
}
