<?php

namespace App\Http\Repositories\Hr;

use App\Http\DTOs\Hr\Template\Request\TemplateStoreDto;
use App\Http\DTOs\Hr\Template\Request\TemplateStoreUpdateDto;
use App\Http\DTOs\Hr\Template\Request\TemplateUpdateDto;
use App\Interfaces\Hr\Template\TemplateRepositoryInterface;
use App\Models\Template;
use App\Models\TemplateType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class TemplateRepository implements TemplateRepositoryInterface
{
    public function __construct(protected Template $template)
    {
    }

    public function getTemplatesByCompanyId(int $companyId): ?LengthAwarePaginator
    {
        return $this->template->select('templates.id', 'templates.name', 'templates.duration', 'templates.timing_code', 'templates.created_at', 'jct.name as job_category_name', 'jsct.name as job_subcategory_name', 'l.name as language')
            ->leftJoin('job_subcategories as jsc', 'jsc.id', 'templates.job_subcategory_id')
            ->leftJoin('job_subcategory_translations as jsct', 'jsct.job_subcategory_id', 'jsc.id')
            ->leftJoin('job_categories as jc', 'jc.id', 'jsc.job_category_id')
            ->leftJoin('job_category_translations as jct', 'jct.job_category_id', 'jc.id')
            ->leftJoin('languages as l', 'l.id', 'templates.language_id')
            ->where('templates.company_id', $companyId)
            ->whereColumn('jsct.language_id', 'templates.language_id')
            ->whereColumn('jct.language_id', 'templates.language_id')
            ->paginate();
    }

    public function getTemplateById(int $id): ?Template
    {
        return $this->template->find($id);
    }

    public function getTemplateDetailsById(int $id): Builder|Model|null
    {
        return $this->template->select('templates.*', 'jc.id as job_category_id', 'templates.name', 'jct.name as job_category_name', 'jsct.name as job_subcategory_name', 'l.name as language')
            ->with(['templateCategories.questions', 'templateCategories.customQuestions', 'templateType'])
            ->leftJoin('job_subcategories as jsc', 'jsc.id', 'templates.job_subcategory_id')
            ->leftJoin('job_subcategory_translations as jsct', 'jsct.job_subcategory_id', 'jsc.id')
            ->leftJoin('job_categories as jc', 'jc.id', 'jsc.job_category_id')
            ->leftJoin('job_category_translations as jct', 'jct.job_category_id', 'jc.id')
            ->leftJoin('languages as l', 'l.id', 'templates.language_id')
            ->where('templates.id', $id)
            ->whereColumn('jsct.language_id', 'templates.language_id')
            ->whereColumn('jct.language_id', 'templates.language_id')
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

    public function updateStore(Template $template, TemplateStoreUpdateDto $templateStoreUpdateDto): bool
    {
        return $template->update(TemplateStoreUpdateDto::toLower($templateStoreUpdateDto->toArray()));
    }

    public function destroy(Template $template): bool
    {
        return $template->delete();
    }
}
