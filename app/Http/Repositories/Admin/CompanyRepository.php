<?php

namespace App\Http\Repositories\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\Company\Request\CompanyRequestDto;
use App\Interfaces\Admin\Company\CompanyRepositoryInterface;
use App\Models\Company;
use Illuminate\Support\Collection;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function __construct(protected Company $company)
    {
    }

    public function companies(): Collection
    {
        return $this->company->get();
    }

    public function companyById(int $id): Company
    {
        $company = $this->company->find($id);
        if (!$company) {
            throw new NotFoundException('Şirkət tapılmadı');
        }
        return $company;
    }

    public function store(CompanyRequestDto $request): Company
    {
        return $this->company->create($request->toArray());
    }

    public function update(int $id, CompanyRequestDto $request): Company
    {
        $company = $this->company->find($id);
        if (!$company) {
            throw new NotFoundException('Şirkət tapılmadı');
        }
        $company->update($request->toArray());
        return $company;
    }

    public function destroy(int $id): Company
    {
        $company = $this->company->find($id);
        if (!$company) {
            throw new NotFoundException('Şirkət tapılmadı');
        }
        $company->delete();
        return $company;
    }
}
