<?php

namespace App\Interfaces\Hr\Template;

use App\Http\DTOs\Hr\Template\Request\TemplateStoreDto;
use App\Http\DTOs\Hr\Template\Request\TemplateUpdateDto;
use App\Models\Template;
use Illuminate\Pagination\LengthAwarePaginator;

interface TemplateRepositoryInterface
{
    public function getTemplatesByCompanyId(int $companyId): ?LengthAwarePaginator;

    public function getTemplateById(int $id): ?Template;

    public function store(TemplateStoreDto $templateStoreDto): Template;

    public function update(Template $template, TemplateUpdateDto $templateUpdateDto): bool;
}
