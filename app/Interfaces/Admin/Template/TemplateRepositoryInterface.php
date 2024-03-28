<?php

namespace App\Interfaces\Admin\Template;

use App\Http\DTOs\Admin\Template\Request\TemplateRequestRepositoryDto;
use App\Models\Template;
use Illuminate\Support\Collection;

interface TemplateRepositoryInterface
{
    public function templates(int $adminId): Collection;

    public function store(TemplateRequestRepositoryDto $request): Template;
}
