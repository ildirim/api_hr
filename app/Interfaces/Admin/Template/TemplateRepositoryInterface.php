<?php

namespace App\Interfaces\Admin\Template;

use App\Http\DTOs\Admin\Template\Request\TemplateRequestRepositoryDto;
use App\Models\Template;

interface TemplateRepositoryInterface
{
    public function store(TemplateRequestRepositoryDto $request): Template;
}
