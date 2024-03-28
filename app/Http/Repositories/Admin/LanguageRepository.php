<?php

namespace App\Http\Repositories\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\Language\Request\LanguageRequestDto;
use App\Http\Requests\Admin\LanguageRequest;
use App\Http\Resources\Admin\LanguageResource;
use App\Interfaces\Admin\Language\LanguageRepositoryInterface;
use App\Models\Language;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class LanguageRepository implements LanguageRepositoryInterface
{
    public function __construct(protected Language $language)
    {
    }

    public function languages(): Collection
    {
        return $this->language->select('id', 'name', 'locale')->get();
    }

    public function languageById(int $id): Language
    {
        $language = $this->language->find($id);
        if (!$language) {
            throw new NotFoundException('Dil tapılmadı');
        }
        return $language;
    }

    public function store(LanguageRequestDto $request): Language
    {
        return $this->language->create($request->toArray());
    }

    public function update(int $id, LanguageRequestDto $request): Language
    {
        $language = $this->language->find($id);
        if (!$language) {
            throw new NotFoundException('Dil tapılmadı');
        }
        $language->update($request->toArray());
        return $language;
    }

    public function destroy(int $id): Language
    {
        $language = $this->language->find($id);
        if (!$language) {
            throw new NotFoundException('Dil tapılmadı');
        }
        $language->delete();
        return $language;
    }
}
