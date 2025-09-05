<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Interfaces\Hr\Template\TemplateServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TemplateController extends Controller
{
    use BaseResponse;

    public function __construct(protected TemplateServiceInterface $templateService)
    {
    }

    public function templateById(int $id): JsonResponse
    {
        $template = $this->templateService->templateById($id);
        return $this->success($template);
    }
}
