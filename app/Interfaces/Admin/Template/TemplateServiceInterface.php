<?php

namespace App\Interfaces\Admin\Template;

use App\Http\DTOs\Admin\Template\Request\TemplateRequestDto;
use App\Http\DTOs\Admin\Template\Response\TemplateResponseDto;

interface TemplateServiceInterface
{
    public function store(TemplateRequestDto $request): TemplateResponseDto;
}
