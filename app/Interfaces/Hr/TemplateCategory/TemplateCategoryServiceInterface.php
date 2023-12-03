<?php

namespace App\Interfaces\Hr\TemplateCategory;

use App\Http\DTOs\Hr\TemplateCategory\Request\TemplateCategoryRequestDto;
use App\Models\TemplateCategory;

interface TemplateCategoryServiceInterface
{
    public function store(TemplateCategoryRequestDto $request): TemplateCategory;
}
