<?php

namespace App\Http\Services\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\TemplateType\Request\TemplateTypeRequestDto;
use App\Http\DTOs\Admin\TemplateType\Response\TemplateTypeResponseDto;
use App\Interfaces\Admin\TemplateType\TemplateTypeRepositoryInterface;
use App\Interfaces\Admin\TemplateType\TemplateTypeServiceInterface;
use Spatie\LaravelData\DataCollection;

class TemplateTypeService implements TemplateTypeServiceInterface
{
    public function __construct(protected TemplateTypeRepositoryInterface $templateTypeRepository)
    {
    }

    public function templateTypes(): DataCollection
    {
        return TemplateTypeResponseDto::collection($this->templateTypeRepository->templateTypes());
    }

    public function templateTypeById(int $id): ?TemplateTypeResponseDto
    {
        $templateType = $this->templateTypeRepository->templateTypeById($id);
        if (!$templateType) {
            return null;
        }
        return TemplateTypeResponseDto::from($templateType);
    }

    public function store(TemplateTypeRequestDto $request): TemplateTypeResponseDto
    {
        $templateType = $this->templateTypeRepository->store($request->toArray());
        return TemplateTypeResponseDto::from($templateType);
    }

    public function update(int $id, TemplateTypeRequestDto $request): TemplateTypeResponseDto
    {
        $templateType = $this->templateTypeRepository->update($id, $request->toArray());
        return TemplateTypeResponseDto::from($templateType);
    }

    public function destroy(int $id): void
    {
        $templateType = $this->templateTypeRepository->templateTypeById($id);
        if (!$templateType) {
            throw new NotFoundException('Template Type not found');
        }
        $this->templateTypeRepository->destroy($templateType);
    }
}
