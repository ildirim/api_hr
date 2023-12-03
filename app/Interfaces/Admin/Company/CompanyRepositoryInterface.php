<?php

namespace App\Interfaces\Admin\Company;

use App\Http\DTOs\Admin\Company\Request\CompanyRequestDto;
use App\Models\Company;
use Illuminate\Support\Collection;

interface CompanyRepositoryInterface
{
    public function companies(): Collection;

    public function companyById(int $id): Company;

    public function store(CompanyRequestDto $request): Company;

    public function update(int $id, CompanyRequestDto $request): Company;

    public function destroy(int $id): Company;
}
