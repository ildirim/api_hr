<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Exception;

class BadRequestException extends Exception
{
    public function render()
    {
        $code = Response::HTTP_BAD_REQUEST;
        $message = 'Error';
        $data = ['error' => [$this->message]];

        $responseData = [
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($responseData, $code);
    }
}
