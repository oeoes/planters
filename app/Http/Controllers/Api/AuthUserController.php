<?php

namespace App\Http\Controllers\Api\v1;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{
    public function test() {
        if (Auth::guard('foreman1')->check()) return Auth::guard('foreman1')->user();    
        if (Auth::guard('foreman2')->check()) return Auth::guard('foreman2')->user();    
    }

    public function login(){
        $credentials = request(['email', 'password']);
        if ($token = Auth::guard('foreman1')->attempt($credentials)) {
            return $this->respondWithToken($token, 'foreman1');
        } else if ($token = Auth::guard('foreman2')->attempt($credentials)) {
            return $this->respondWithToken($token, 'foreman2');
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function me(){
        return JWTAuth::parseToken()->authenticate();
    }

    public function logout(){
        if (auth()->guard('foreman1')->check()) auth()->guard('foreman1')->logout();
        if (auth()->guard('foreman2')->check()) auth()->guard('foreman2')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh() {
        if (Auth::guard('foreman1')->check()) return $this->respondWithToken(auth('foreman1')->refresh());
        if (Auth::guard('foreman2')->check()) return $this->respondWithToken(auth('foreman2')->refresh());
    }

    protected function respondWithToken($token, $foreman) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth($foreman)->factory()->getTTL() * 60,
            'account' => auth($foreman)->user()
        ]);
    }
}