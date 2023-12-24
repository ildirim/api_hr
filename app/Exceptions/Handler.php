<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof NotFoundException) {
            return $e->render();
        }
        dd($e);
        return response()->json($this->responseData(
            Response::HTTP_BAD_REQUEST,
            'error', $e->getMessage()),
            Response::HTTP_BAD_REQUEST
        );
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
