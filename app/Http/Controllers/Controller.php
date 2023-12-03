<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function success(int $code = Response::HTTP_OK, $data = [], ?array $additional = null): JsonResponse
    {
        try {
            $responseData = $this->responseData($code, 'success', $data);

            if ($additional) {
                foreach ($additional as $key => $value) {
                    $responseData[$key] = $value;
                }
            }
            return response()->json($responseData, $code);
        } catch (\Exception $e) {
            return $this->error(Response::HTTP_BAD_REQUEST, $e->getMessage());
        }
    }

    public function error(int $code = Response::HTTP_BAD_REQUEST, $data = []): JsonResponse
    {
        return response()->json($this->responseData($code, 'error', $data), $code);
    }

    private function responseData(int $code = Response::HTTP_OK, ?string $message = null, $data = []): array
    {
        return [
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }
}
