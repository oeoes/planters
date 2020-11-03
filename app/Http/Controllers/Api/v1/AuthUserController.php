<?php

namespace App\Http\Controllers\Api\v1;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{
    public function test() {
        if (Auth::guard('md1')->check()) return Auth::guard('md1')->user();    
        if (Auth::guard('md2')->check()) return Auth::guard('md2')->user();    
    }

    public function login(){
        $credentials = request(['email', 'password']);
        if ($token = Auth::guard('md1')->attempt($credentials)) {
            return $this->respondWithToken($token, 'md1');
        } else if ($token = Auth::guard('md2')->attempt($credentials)) {
            return $this->respondWithToken($token, 'md2');
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function me(){
        return JWTAuth::parseToken()->authenticate();
    }

    public function logout(){
        if (auth()->guard('md1')->check()) auth()->guard('md1')->logout();
        if (auth()->guard('md2')->check()) auth()->guard('md2')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh() {
        if (Auth::guard('md1')->check()) return $this->respondWithToken(auth('md1')->refresh());
        if (Auth::guard('md2')->check()) return $this->respondWithToken(auth('md2')->refresh());
    }

    protected function respondWithToken($token, $md) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth($md)->factory()->getTTL() * 60,
            'account' => auth($md)->user()
        ]);
    }
}