<?php

namespace App\Http\Services\Hr;

use App\Http\DTOs\Hr\Template\Response\TemplateByIdResponseDto;
use App\Interfaces\Hr\Template\TemplateRepositoryInterface;
use App\Interfaces\Hr\Template\TemplateServiceInterface;

class TemplateService implements TemplateServiceInterface
{
    public function __construct(
        protected TemplateRepositoryInterface $templateRepository,
    )
    {
    }

    public function templateById(int $id): ?TemplateByIdResponseDto
    {
        $companyId = auth('admin')->user()->company_id;
        $template = $this->templateRepository->templateById($id, $companyId);
        if (!$template) {
            return null;
        }
        return TemplateByIdResponseDto::from($template);
    }
}
