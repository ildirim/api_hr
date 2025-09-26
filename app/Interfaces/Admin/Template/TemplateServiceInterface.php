<?php

namespace App\Interfaces\Admin\Template;

use App\Http\DTOs\Admin\Template\Request\TemplateRequestDto;
use App\Http\DTOs\Admin\Template\Response\TemplateResponseDto;
use Spatie\LaravelData\DataCollection;

interface TemplateServiceInterface
{
    public function getTemplatesByCompanyId(int $companyId): DataCollection;

    public function store(TemplateRequestDto $request): void;
}
