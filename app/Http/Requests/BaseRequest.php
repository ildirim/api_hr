<?php

namespace App\Http\Requests;

use App\Traits\BaseResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class BaseRequest extends FormRequest
{
    use BaseResponse;

    protected $redirectRoute = 'test';

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->error($validator->errors(),
                'Validation Failed',
                'error',
                Response::HTTP_UNPROCESSABLE_ENTITY
            )
        );

    }
}
