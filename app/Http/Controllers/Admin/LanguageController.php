<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\Language\Request\LanguageRequestDto;
use App\Http\Requests\Admin\LanguageRequest;
use App\Interfaces\Admin\Language\LanguageServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LanguageController extends Controller
{
    use BaseResponse;

    public function __construct(protected LanguageServiceInterface $languageService)
    {
    }

    public function languages(): JsonResponse
    {
        $languages = $this->languageService->languages();
        return $this->success($languages);
    }

    public function languageById(int $id): JsonResponse
    {
        $language = $this->languageService->languageById($id);
        return $this->success($language);
    }

    public function store(LanguageRequest $request): JsonResponse
    {
        $languageRequestDto = LanguageRequestDto::fromRequest($request);
        $language = $this->languageService->store($languageRequestDto);
        return $this->success($language, 'Language created successfully', 'success', Response::HTTP_CREATED);
    }

    public function update(int $id, LanguageRequest $request): JsonResponse
    {
        $languageRequestDto = LanguageRequestDto::fromRequest($request);
        $language = $this->languageService->update($id, $languageRequestDto);
        return $this->success($language);
    }

    public function destroy($id): JsonResponse
    {
        $result = $this->languageService->destroy($id);
        return $this->success($result);
    }
}
