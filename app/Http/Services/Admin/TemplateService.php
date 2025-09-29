<?php

namespace App\Http\Services\Admin;

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
}
