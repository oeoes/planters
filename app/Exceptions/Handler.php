<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

use Tymon\JWTAuth\Facades\JWTAuth;


class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        //
    }

    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson()) {   //add Accept: application/json in request
            try {
                // $headers = apache_request_headers(); //get header
                // $request->headers->set('Authorization', $headers['authorization']);// set header in request
                
                JWTAuth::parseToken()->authenticate();
            } catch (Throwable $e) {
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                    return res(false, 400, 'Token invalid');
                }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                    return res(false, 400, 'Token expired');
                }else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                    return res(false, 400, 'Token blacklisted');
                } else {
                    return res(false, 400, 'Token not found');
                }
            }

            return res(false, 404, $exception->getMessage());
            
        } else {
            // if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
            //     return redirect('/login');
                
            if(Auth::guard('assistant')->check()) {}
                return parent::render($request, $exception);

            if(Auth::guard('farmmanager')->check())
                return parent::render($request, $exception);

            if(Auth::guard('superadmin')->check())
                return parent::render($request, $exception);
            
            return redirect('/login');
        }
            
    }
}
