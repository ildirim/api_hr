<?php

namespace App\Http\Repositories\Admin;

use App\Http\DTOs\Admin\Template\Request\TemplateRequestDto;
use App\Http\DTOs\Admin\Template\Request\TemplateRequestRepositoryDto;
use App\Http\Requests\Admin\TemplateRequest;
use App\Http\Resources\Admin\TemplateResource;
use App\Interfaces\Admin\Template\TemplateRepositoryInterface;
use App\Models\Template;
use Illuminate\Support\Collection;

class TemplateRepository implements TemplateRepositoryInterface
{
    public function __construct(protected Template $template)
    {
    }

    public function templates(int $adminId): Collection
    {
        return $this->template->select('t.id', 't.name', 't.duration', 't.plan_code', 't.timing_code', 't.created_at', 'jct.name as job_category_name', 'jsct.name as job_subcategory_name', 'l.name as language')
            ->from('templates as t')
            ->leftJoin('job_subcategories as jsc', 'jsc.id', 't.job_subcategory_id')
            ->leftJoin('job_subcategory_translations as jsct', 'jsct.job_subcategory_id', 'jsc.id')
            ->leftJoin('job_categories as jc', 'jc.id', 'jsc.job_category_id')
            ->leftJoin('job_category_translations as jct', 'jct.job_category_id', 'jc.id')
            ->leftJoin('languages as l', 'l.id', 't.language_id')
            ->where('jsct.language_id', 't.language_id')
            ->where('jct.language_id', 't.language_id')
            ->get();
    }

    public function store(TemplateRequestRepositoryDto $request): Template
    {
        return $this->template->create($request->toArray());
    }
}
