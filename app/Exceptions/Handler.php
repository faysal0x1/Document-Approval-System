<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
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
        $this->renderable(function (Throwable $e) {
            if ($e instanceof AuthorizationException ||
                $e instanceof AccessDeniedHttpException) {
                if (! auth()->check()) {
                    return redirect()->route('login')->with('error', 'Please login to access this page.');
                }

                return redirect()
                    ->back()
                    ->with('error', 'You do not have permission to access this resource.');
            }
        });

        // Handle JWT exceptions with custom responses
        $this->renderable(function (TokenExpiredException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token has expired',
                    'error_type' => 'token_expired',
                ], 401);
            }
        });

        $this->renderable(function (TokenInvalidException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token is invalid',
                    'error_type' => 'token_invalid',
                ], 401);
            }
        });

        $this->renderable(function (JWTException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token is missing or could not be parsed',
                    'error_type' => 'token_absent',
                ], 401);
            }
        });
    }

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        AuthorizationException::class,
        AccessDeniedHttpException::class,
    ];
}
