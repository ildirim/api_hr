<?php

namespace App\Http\Repositories\Admin;

use App\Http\DTOs\Admin\TemplateType\Request\TemplateTypeRequestDto;
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

    public function store(TemplateTypeRequestDto $request): TemplateType
    {
        $data = TemplateTypeRequestDto::toLower($request->toArray());
        return $this->templateType->create($data);
    }

    public function update(TemplateType $templateType, TemplateTypeRequestDto $request): TemplateType
    {
        $data = TemplateTypeRequestDto::toLower($request->toArray());
        $templateType->update($data);
        return $templateType;
    }

    public function destroy(TemplateType $templateType): bool
    {
        return $templateType->delete();
    }
}



