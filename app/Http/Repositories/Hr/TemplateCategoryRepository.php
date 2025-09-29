<?php

namespace App\Http\Repositories\Hr;

use App\Http\DTOs\Hr\TemplateCategory\Request\TemplateCategoryStoreDto;
use App\Interfaces\Hr\TemplateCategory\TemplateCategoryRepositoryInterface;
use App\Models\TemplateCategory;

class TemplateCategoryRepository implements TemplateCategoryRepositoryInterface
{
    public function __construct(protected TemplateCategory $templateCategory)
    {
    }

    public function store(TemplateCategoryStoreDto $templateCategoryStoreDto): TemplateCategory
    {
        return $this->templateCategory->create($templateCategoryStoreDto->toArray());
    }
}
