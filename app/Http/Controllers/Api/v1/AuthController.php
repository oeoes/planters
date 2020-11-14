<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request) {
        if ($token = Auth::guard('foreman1')->attempt($request->all())) {
            return $this->respondWithToken($token, 'foreman1');
        } else if ($token = Auth::guard('foreman2')->attempt($request->all())) {
            return $this->respondWithToken($token, 'foreman2');
        }
        return res(false, 401, 'Unauthorized, invalid email or password');
    }

    public function logout() {
        // return 'p';
        if (Auth::guard('foreman1')->check()) {
            Auth::guard('foreman1')->logout();
        }
        if (Auth::guard('foreman2')->check()) {
            Auth::guard('foreman2')->logout();
        }
        return res(true, 200, 'Successfully logged out');
    }

    protected function respondWithToken($token, $guard)
    {   
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard($guard)->factory()->getTTL() * 60,
            'account' => Auth::guard($guard)->user()
        ];
        return res(true, 200, 'Successfully log in', $data);
    }
}
