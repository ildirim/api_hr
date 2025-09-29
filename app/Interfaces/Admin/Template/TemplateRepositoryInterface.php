<?php

namespace App\Interfaces\Admin\Template;

use Illuminate\Support\Collection;

interface TemplateRepositoryInterface
{
    public function templates(int $adminId): Collection;
}
