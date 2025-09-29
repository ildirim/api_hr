<?php

namespace App\Interfaces\Hr\TemplateCategory;

use App\Http\DTOs\Hr\TemplateCategory\Request\TemplateCategoryStoreDto;
use App\Models\TemplateCategory;

interface TemplateCategoryRepositoryInterface
{
    public function store(TemplateCategoryStoreDto $templateCategoryStoreDto): TemplateCategory;
}
