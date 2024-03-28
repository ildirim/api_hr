<?php

namespace App\Interfaces\Hr\Template;

use App\Models\Template;
use Illuminate\Support\Collection;

interface TemplateRepositoryInterface
{
    public function templateById(int $id, int $companyId): ?Template;
}
