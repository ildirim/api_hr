<?php

namespace App\Interfaces\Admin\Company;

use App\Http\DTOs\Admin\Company\Request\CompanyRequestDto;
use App\Http\DTOs\Admin\Company\Response\CompanyResponseDto;
use Spatie\LaravelData\DataCollection;

interface CompanyServiceInterface
{
    public function companies(): DataCollection;

    public function companyById(int $id): CompanyResponseDto;

    public function store(CompanyRequestDto $request): CompanyResponseDto;

    public function update(int $id, CompanyRequestDto $request): CompanyResponseDto;

    public function destroy(int $id): CompanyResponseDto;
}
