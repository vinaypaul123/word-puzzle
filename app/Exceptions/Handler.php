<?php

namespace App\Exceptions;

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
        $this->renderable(function (\App\Exceptions\InvalidWordException $e, $request) {
            return response()->view('errors.custom', ['message' => $e->getMessage()], 422);
        });

        $this->renderable(function (\App\Exceptions\UsedLettersExceededException $e, $request) {
            return response()->view('errors.custom', ['message' => $e->getMessage()], 422);
        });
    }
}
