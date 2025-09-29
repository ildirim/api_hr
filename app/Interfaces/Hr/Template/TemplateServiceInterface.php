<?php

namespace App\Interfaces\Hr\Template;

use App\Http\DTOs\Hr\Template\Request\TemplateStoreDto;
use App\Http\DTOs\Hr\Template\Request\TemplateUpdateDto;
use App\Http\DTOs\Hr\Template\Response\TemplateByIdResponseDto;

interface TemplateServiceInterface
{
    public function getTemplateById(int $id): ?TemplateByIdResponseDto;

    public function store(TemplateStoreDto $templateStoreDto): void;

    public function update(int $id, TemplateUpdateDto $templateUpdateDto): void;
}
