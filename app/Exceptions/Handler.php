<?php

namespace App\Exceptions;

use App\Traits\BaseResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    use BaseResponse;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (ValidationException $e) {
            return $this->error($e->errors(), $e->getMessage());
        });

        $this->renderable(function (\Throwable $e) {
            return $this->error([], $e->getMessage());
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof NotFoundException) {
            return $e->render();
        } elseif ($e instanceof BadRequestException) {
            return $e->render();
        } elseif ($e instanceof ValidationException) {
            return $this->error($e->errors(), $e->getMessage());
        }

        return $this->error([], $e->getMessage());
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
