<?php

namespace App\Exceptions;

use App\Helpers\Responder;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 * Handler for exceptions
 */
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
        $this->renderable(
            function (Throwable $exception): JsonResponse
            {
                $httpStatusCode = 500;

                if (method_exists($exception, 'getStatusCode')) {
                    $httpStatusCode = $exception->getStatusCode();
                } elseif (is_subclass_of($exception, Exceptions::class)) {
                    $httpStatusCode = $exception->getHttpStatusCode();
                }

                return Responder::error(
                    errorCode: $exception->getCode(),
                    errorMessage: $exception->getMessage(),
                    httpStatusCode: $httpStatusCode,
                );
            }
        );
    }
}
