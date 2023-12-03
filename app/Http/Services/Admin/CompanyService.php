<?php

namespace App\Http\Services\Admin;

use App\Http\DTOs\Admin\Company\Request\CompanyRequestDto;
use App\Http\DTOs\Admin\Company\Response\CompanyResponseDto;
use App\Interfaces\Admin\Company\CompanyRepositoryInterface;
use App\Interfaces\Admin\Company\CompanyServiceInterface;
use Spatie\LaravelData\DataCollection;

class CompanyService implements CompanyServiceInterface
{
    public function __construct(protected CompanyRepositoryInterface $companyRepository)
    {
    }

    public function companies(): DataCollection
    {
        return CompanyResponseDto::collection($this->companyRepository->companies());
    }

    public function companyById(int $id): CompanyResponseDto
    {
        return CompanyResponseDto::from($this->companyRepository->companyById($id));
    }

    public function store(CompanyRequestDto $request): CompanyResponseDto
    {
        return CompanyResponseDto::from($this->companyRepository->store($request));
    }

    public function update(int $id, CompanyRequestDto $request): CompanyResponseDto
    {
        return CompanyResponseDto::from($this->companyRepository->update($id, $request));
    }

    public function destroy(int $id): CompanyResponseDto
    {
        return CompanyResponseDto::from($this->companyRepository->destroy($id));
    }
}
