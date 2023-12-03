<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Exception;

class NotFoundException extends Exception
{
    public function render()
    {
        $code = Response::HTTP_NOT_FOUND;
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
