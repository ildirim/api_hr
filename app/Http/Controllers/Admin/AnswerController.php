<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AnswerRequest;
use App\Interfaces\Admin\Answer\AnswerServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AnswerController extends Controller
{
    public function __construct(protected AnswerServiceInterface $answerService)
    {
    }

    public function answers(): JsonResponse
    {
        try {
            $answers = $this->answerService->answers();
            return $this->success(Response::HTTP_OK, $answers);
        } catch (\Exception $e) {
            return $this->error(Response::HTTP_BAD_REQUEST, ['error' => [$e->getMessage()]]);
        }
    }

    public function answerById(int $id): JsonResponse
    {
        try {
            $answer = $this->answerService->answerById($id);
            return $this->success(Response::HTTP_CREATED, $answer);
        } catch (\Exception $e) {
            return $this->error(Response::HTTP_BAD_REQUEST, ['error' => [$e->getMessage()]]);
        }
    }

    public function update(int $id, AnswerRequest $request): JsonResponse
    {
        try {
            $result = $this->answerService->update($id, $request);
            return $this->success(Response::HTTP_OK, $result);
        } catch (NotFoundException $e) {
            return $e->render();
        } catch (\Exception $e) {
            return $this->error(Response::HTTP_BAD_REQUEST, ['error' => [$e->getMessage()]]);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $result = $this->answerService->destroy($id);
            return $this->success(Response::HTTP_OK, $result);
        } catch (NotFoundException $e) {
            return $e->render();
        } catch (\Exception $e) {
            return $this->error(Response::HTTP_BAD_REQUEST, ['error' => [$e->getMessage()]]);
        }
    }
}
