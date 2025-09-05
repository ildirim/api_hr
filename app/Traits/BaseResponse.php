<?php

namespace App\Traits;

use App\DTO\Common\ErrorResponseDto;
use App\DTO\Common\SuccessResponseDto;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait BaseResponse
{
    public function success(
        array|object|null $data = [],
        string $message = 'OK',
        string $status = 'success',
        int $code = Response::HTTP_OK,
    ): JsonResponse
    {
        try {
            $response = SuccessResponseDto::from([
                'message' => $message,
                'status' => $status,
                'data' => $data
            ]);
            return response()->json($response, $code);
        } catch (\Exception $e) {
            return $this->error(null, $e->getMessage());
        }
    }

    public function error(
        array|object|null $errors = [],
        string $message = '',
        string $status = 'error',
        int $code = Response::HTTP_BAD_REQUEST,
    ): JsonResponse
    {
        $response = ErrorResponseDto::from([
            'message' => $message,
            'status' => $status,
            'errors' => $errors
        ]);
        return response()->json($response, $code);
    }
}
