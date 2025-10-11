<?php

namespace App\Http\Repositories\Admin;

use App\Interfaces\Admin\TemplateType\TemplateTypeRepositoryInterface;
use App\Models\TemplateType;
use Illuminate\Support\Collection;

class TemplateTypeRepository implements TemplateTypeRepositoryInterface
{
    public function __construct(protected TemplateType $templateType)
    {
    }

    public function templateTypes(): Collection
    {
        return $this->templateType->select('id', 'name')->get();
    }

    public function templateTypeById(int $id): ?TemplateType
    {
        return $this->templateType->select('id', 'name')->find($id);
    }

    public function store(array $data): TemplateType
    {
        return $this->templateType->create($data);
    }

    public function update(int $id, array $data): TemplateType
    {
        $templateType = $this->templateType->findOrFail($id);
        $templateType->update($data);
        return $templateType;
    }

    public function destroy(TemplateType $templateType): bool
    {
        return $templateType->delete();
    }
}



