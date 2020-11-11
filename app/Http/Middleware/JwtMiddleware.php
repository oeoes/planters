<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Exception;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        try {
            $user = auth()->guard('foreman1')->check();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'Token is Expired']);
            }else if($e instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
                return response()->json(['status' => 'Authorization Token not found']);
            }
        }
        // return 'asda';
        return $user;


        // try {
        //     $user = JWTAuth::parseToken()->authenticate();
        // } catch (TokenExpiredException $e) {
        //     return response()->json(['error' => 'TOKEN_INVALID'], 401);
        // } catch (TokenInvalidException $e) {
        //     return response()->json(['error' => 'TOKEN_INVALID'], 401);
        // } catch (JWTException $e) {
        //     return response()->json(['error' => 'TOKEN_NOT_PROVIDED'], 401);
        // } 
        // return $next($request);
    }
}
