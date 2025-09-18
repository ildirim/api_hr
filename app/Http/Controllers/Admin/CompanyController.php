<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\Company\Request\CompanyRequestDto;
use App\Http\Requests\Admin\CompanyRequest;
use App\Interfaces\Admin\Company\CompanyServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
    use BaseResponse;

    public function __construct(protected CompanyServiceInterface $companyService)
    {
    }

    public function companies(): JsonResponse
    {
        $companies = $this->companyService->companies();
        return $this->success($companies);
    }

    public function companyById(int $id): JsonResponse
    {
        $company = $this->companyService->companyById($id);
        return $this->success($company);
    }

    public function store(CompanyRequest $request): JsonResponse
    {
        $requestDto = CompanyRequestDto::from($request);
        $company = $this->companyService->store($requestDto);
        return $this->success($company, 'Company created successfully', 'success', Response::HTTP_CREATED);
    }

    public function update(int $id, CompanyRequest $request): JsonResponse
    {
        $requestDto = CompanyRequestDto::from($request);
        $result = $this->companyService->update($id, $requestDto);
        return $this->success($result);
    }

    public function destroy($id): JsonResponse
    {
        $result = $this->companyService->destroy($id);
        return $this->success($result);
    }
}
