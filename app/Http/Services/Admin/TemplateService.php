<?php

namespace App\Http\Services\Admin;

use App\Http\DTOs\Admin\Template\Request\TemplateRequestDto;
use App\Http\DTOs\Admin\Template\Response\TemplateResponseDto;
use App\Interfaces\Admin\Template\TemplateRepositoryInterface;
use App\Interfaces\Admin\Template\TemplateServiceInterface;
use Spatie\LaravelData\DataCollection;

class TemplateService implements TemplateServiceInterface
{
    public function __construct(
        protected TemplateRepositoryInterface $templateRepository,
    )
    {
    }

    public function getTemplatesByCompanyId($companyId): DataCollection
    {
        $templates = $this->templateRepository->templates($companyId);
        return TemplateResponseDto::collection($templates);
    }

    public function store(TemplateRequestDto $request): TemplateResponseDto
    {
        return TemplateResponseDto::from($this->templateRepository->store($request));
    }
}
