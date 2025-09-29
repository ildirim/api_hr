<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\Template\TemplateServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;

class TemplateController extends Controller
{
    use BaseResponse;

    public function __construct(protected TemplateServiceInterface $templateService)
    {
    }

    public function getTemplatesByCompanyId(): JsonResponse
    {
        $templates = $this->templateService->getTemplatesByCompanyId(auth('admin')->user()->company_id);
        return $this->success($templates);
    }
}
