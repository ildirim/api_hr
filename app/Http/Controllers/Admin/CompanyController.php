<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\Company\Request\CompanyRequestDto;
use App\Http\Requests\Admin\CompanyRequest;
use App\Interfaces\Admin\Company\CompanyServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
    public function __construct(protected CompanyServiceInterface $companyService)
    {
    }

    public function companies(): JsonResponse
    {
        $companies = $this->companyService->companies();
        return $this->success(Response::HTTP_OK, $companies);
    }

    public function companyById(int $id): JsonResponse
    {
        $company = $this->companyService->companyById($id);
        return $this->success(Response::HTTP_OK, $company);
    }

    public function store(CompanyRequest $request): JsonResponse
    {
        $requestDto = CompanyRequestDto::fromRequest($request);
        $company = $this->companyService->store($requestDto);
        return $this->success(Response::HTTP_CREATED, $company);
    }

    public function update(int $id, CompanyRequest $request): JsonResponse
    {
        $requestDto = CompanyRequestDto::fromRequest($request);
        $result = $this->companyService->update($id, $requestDto);
        return $this->success(Response::HTTP_OK, $result);
    }

    public function destroy($id): JsonResponse
    {
        $result = $this->companyService->destroy($id);
        return $this->success(Response::HTTP_OK, $result);
    }
}
