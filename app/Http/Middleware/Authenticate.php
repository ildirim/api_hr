<?php

namespace App\Http\Middleware;

use App\Traits\BaseResponse;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    use BaseResponse;
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : $this->error(null, 'Unauthorized', 'error', Response::HTTP_UNAUTHORIZED);
    }
}
