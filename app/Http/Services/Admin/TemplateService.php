<?php

namespace App\Http\Services\Admin;

use App\Http\DTOs\Admin\Template\Request\TemplateRequestDto;
use App\Http\DTOs\Admin\Template\Response\TemplateResponseDto;
use App\Http\Mappers\Admin\Template\TemplateRequestMapper;
use App\Interfaces\Admin\Template\TemplateRepositoryInterface;
use App\Interfaces\Admin\Template\TemplateServiceInterface;

class TemplateService implements TemplateServiceInterface
{
    public function __construct(
        protected TemplateRepositoryInterface $templateRepository,
    )
    {
    }

    public function store(TemplateRequestDto $requestDto): TemplateResponseDto
    {
        $templateRepositoryRequestDto = TemplateRequestMapper::requestToDto($requestDto);
        return TemplateResponseDto::from($this->templateRepository->store($templateRepositoryRequestDto));
    }
}
