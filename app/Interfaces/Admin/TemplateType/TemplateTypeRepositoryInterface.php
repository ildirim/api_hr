<?php

namespace App\Interfaces\Admin\TemplateType;

use App\Http\DTOs\Admin\TemplateType\Request\TemplateTypeRequestDto;
use App\Models\TemplateType;
use Illuminate\Support\Collection;

interface TemplateTypeRepositoryInterface
{
    public function templateTypes(): Collection;

    public function templateTypeById(int $id): ?TemplateType;

    public function store(TemplateTypeRequestDto $request): TemplateType;

    public function update(TemplateType $templateType, TemplateTypeRequestDto $request): TemplateType;

    public function destroy(TemplateType $templateType): bool;
}
