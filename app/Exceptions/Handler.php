<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function render($request, Throwable $e)
    {
      try {
            JWTAuth::parseToken()->authenticate();
      } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

        return response()->json(['error' => 'Token Expired'], 401);

      } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

        return response()->json(['error' => 'Token Invalid'], 401); 

      } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

        return response()->json(['error' => 'Token not provided'], 401);

      }
    }

}
