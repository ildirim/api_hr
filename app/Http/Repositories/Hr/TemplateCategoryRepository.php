<?php

namespace App\Http\Repositories\Hr;

use App\Http\DTOs\Hr\Question\Request\QuestionMixedRequestDto;
use App\Http\DTOs\Hr\TemplateCategory\Request\TemplateCategoryListRequestDto;
use App\Http\DTOs\Hr\TemplateCategory\Request\TemplateCategoryRequestDto;
use App\Interfaces\Hr\Question\QuestionRepositoryInterface;
use App\Interfaces\Hr\TemplateCategory\TemplateCategoryRepositoryInterface;
use App\Models\Question;
use App\Models\TemplateCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TemplateCategoryRepository implements TemplateCategoryRepositoryInterface
{
    public function __construct(protected TemplateCategory $templateCategory)
    {
    }

    public function store(TemplateCategoryRequestDto $requestDto): TemplateCategory
    {
        return $this->templateCategory->create($requestDto->toArray());
    }
}
