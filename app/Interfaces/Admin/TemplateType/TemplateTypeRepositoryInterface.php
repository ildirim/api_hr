<?php

namespace App\Interfaces\Admin\TemplateType;

use App\Models\TemplateType;
use Illuminate\Support\Collection;

interface TemplateTypeRepositoryInterface
{
    public function templateTypes(): Collection;

    public function templateTypeById(int $id): ?TemplateType;

    public function store(array $data): TemplateType;

    public function update(int $id, array $data): TemplateType;

    public function destroy(TemplateType $templateType): bool;
}
