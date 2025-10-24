<?php

namespace App\Http\Repositories\Hr;

use App\Http\DTOs\Hr\Template\Request\TemplateStoreDto;
use App\Http\DTOs\Hr\Template\Request\TemplateUpdateDto;
use App\Interfaces\Hr\Template\TemplateRepositoryInterface;
use App\Models\Template;
use App\Models\TemplateType;
use Illuminate\Pagination\LengthAwarePaginator;

class TemplateRepository implements TemplateRepositoryInterface
{
    public function __construct(protected Template $template)
    {
    }

    public function getTemplatesByCompanyId(int $companyId): ?LengthAwarePaginator
    {
        return $this->template->select('t.id', 't.name', 't.duration', 't.timing_code', 't.created_at', 'jct.name as job_category_name', 'jsct.name as job_subcategory_name', 'l.name as language')
            ->from('templates as t')
            ->leftJoin('job_subcategories as jsc', 'jsc.id', 't.job_subcategory_id')
            ->leftJoin('job_subcategory_translations as jsct', 'jsct.job_subcategory_id', 'jsc.id')
            ->leftJoin('job_categories as jc', 'jc.id', 'jsc.job_category_id')
            ->leftJoin('job_category_translations as jct', 'jct.job_category_id', 'jc.id')
            ->leftJoin('languages as l', 'l.id', 't.language_id')
            ->where('t.company_id', $companyId)
            ->whereColumn('jsct.language_id', 't.language_id')
            ->whereColumn('jct.language_id', 't.language_id')
            ->paginate();
    }

    public function getTemplateById(int $id): ?Template
    {
        return $this->template->find($id);
    }

    public function getTemplateDetailsById(int $id): ?Template
    {
        return $this->template->select('t.id', 't.company_id', 't.job_subcategory_id', 't.language_id', 'jc.id as job_category_id', 't.name', 'jct.name as job_category_name', 'jsct.name as job_subcategory_name', 'l.name as language')
            ->from('templates as t')
            ->leftJoin('job_subcategories as jsc', 'jsc.id', 't.job_subcategory_id')
            ->leftJoin('job_subcategory_translations as jsct', 'jsct.job_subcategory_id', 'jsc.id')
            ->leftJoin('job_categories as jc', 'jc.id', 'jsc.job_category_id')
            ->leftJoin('job_category_translations as jct', 'jct.job_category_id', 'jc.id')
            ->leftJoin('languages as l', 'l.id', 't.language_id')
            ->where('t.id', $id)
            ->whereColumn('jsct.language_id', 't.language_id')
            ->whereColumn('jct.language_id', 't.language_id')
            ->first();
    }

    public function getTemplateTypeByTemplateId(int $id): ?TemplateType
    {
        return $this->template->with('templateType')->find($id)?->templateType;
    }

    public function store(TemplateStoreDto $templateStoreDto): Template
    {
        return $this->template->create(TemplateStoreDto::toLower($templateStoreDto->toArray()));
    }

    public function update(Template $template, TemplateUpdateDto $templateUpdateDto): bool
    {
        return $template->update(TemplateUpdateDto::toLower($templateUpdateDto->toArray()));
    }
}
