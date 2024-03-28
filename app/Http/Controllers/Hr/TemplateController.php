<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Interfaces\Hr\Template\TemplateServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TemplateController extends Controller
{
    public function __construct(protected TemplateServiceInterface $templateService)
    {
    }

    public function templateById(int $id): JsonResponse
    {
        $template = $this->templateService->templateById($id);
        return $this->success(Response::HTTP_OK, $template);
    }
}
