<?php

namespace App\Exceptions;

use App\Traits\BaseResponse;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class InvalidRefreshTokenException extends Exception
{
    use BaseResponse;

    public function render()
    {
        return $this->error(null, $this->message, 'error', Response::HTTP_UNAUTHORIZED);
    }
}