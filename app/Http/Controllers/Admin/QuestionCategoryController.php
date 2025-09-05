<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\QuestionCategory\Request\QuestionCategoryRequestDto;
use App\Http\Requests\Admin\QuestionCategoryRequest;
use App\Interfaces\Admin\QuestionCategory\QuestionCategoryServiceInterface;
use App\Traits\BaseResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class QuestionCategoryController extends Controller
{
    use BaseResponse;

    public function __construct(protected QuestionCategoryServiceInterface $questionCategoryService)
    {
    }

    public function questionCategories(): JsonResponse
    {
        $questionCategories = $this->questionCategoryService->questionCategories();
        return $this->success($questionCategories);
    }

    public function questionCategoryById(int $id): JsonResponse
    {
        $questionCategory = $this->questionCategoryService->questionCategoryById($id);
        return $this->success($questionCategory);
    }

    public function store(QuestionCategoryRequest $request): JsonResponse
    {
        $requestDto = QuestionCategoryRequestDto::fromRequest($request);
        $questionCategory = $this->questionCategoryService->store($requestDto);
        return $this->success($questionCategory, 'Question category created successfully', 'success', Response::HTTP_CREATED);
    }

    public function update(int $id, QuestionCategoryRequest $request): JsonResponse
    {
        $requestDto = QuestionCategoryRequestDto::fromRequest($request);
        $result = $this->questionCategoryService->update($id, $requestDto);
        return $this->success($result);
    }

    public function destroy($id): JsonResponse
    {
        $result = $this->questionCategoryService->destroy($id);
        return $this->success($result);
    }
}
