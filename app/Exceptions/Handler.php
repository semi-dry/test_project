<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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

        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception|\Throwable  $e
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function render($request, Exception|Throwable $e)
    {

        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Data not found'
            ], 404);
        }
        return parent::render($request, $e);
    }

    protected function unauthenticated($request, AuthenticationException $e)
    {
        return response()->json(['error' => 'Unauthenticated'], 401);
    }

}
