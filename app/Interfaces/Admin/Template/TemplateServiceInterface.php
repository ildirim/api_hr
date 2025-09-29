<?php

namespace App\Interfaces\Admin\Template;

use Spatie\LaravelData\DataCollection;

interface TemplateServiceInterface
{
    public function getTemplatesByCompanyId(int $companyId): DataCollection;
}
