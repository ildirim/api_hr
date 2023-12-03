<?php

namespace App\Http\Repositories\Admin;

use App\Http\DTOs\Admin\Template\Request\TemplateRequestDto;
use App\Http\DTOs\Admin\Template\Request\TemplateRequestRepositoryDto;
use App\Http\Requests\Admin\TemplateRequest;
use App\Http\Resources\Admin\TemplateResource;
use App\Interfaces\Admin\Template\TemplateRepositoryInterface;
use App\Models\Template;

class TemplateRepository implements TemplateRepositoryInterface
{
    public function __construct(protected Template $template)
    {
    }

    public function store(TemplateRequestRepositoryDto $request): Template
    {
        return $this->template->create($request->toArray());
    }
}
