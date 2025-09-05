<?php

namespace App\Exceptions;

use App\Traits\BaseResponse;
use Exception;

class BadRequestException extends Exception
{
    use BaseResponse;

    public function render()
    {
        return $this->error($this->message);
    }
}
