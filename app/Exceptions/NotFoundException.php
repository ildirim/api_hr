<?php

namespace App\Exceptions;

use App\Traits\BaseResponse;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class NotFoundException extends Exception
{
    use BaseResponse;

    public function render()
    {
        return $this->error(null, $this->message, 'error', Response::HTTP_NOT_FOUND);
    }
}
