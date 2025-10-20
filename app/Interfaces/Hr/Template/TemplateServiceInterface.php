<?php

namespace App\Interfaces\Hr\Template;

use App\Http\DTOs\Hr\Template\Request\TemplateStoreDto;
use App\Http\DTOs\Hr\Template\Request\TemplateUpdateDto;
use App\Http\DTOs\Hr\Template\Response\TemplateByIdResponseDto;
use Spatie\LaravelData\PaginatedDataCollection;

interface TemplateServiceInterface
{
    public function getTemplatesByCompanyId(int $companyId): ?PaginatedDataCollection;

    public function getTemplateById(int $id): ?TemplateByIdResponseDto;

    public function store(TemplateStoreDto $templateStoreDto): TemplateByIdResponseDto;

    public function update(int $id, TemplateUpdateDto $templateUpdateDto): void;
}
