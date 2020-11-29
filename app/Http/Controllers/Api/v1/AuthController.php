<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        if ($token = Auth::guard('foreman')->attempt($request->all())) {
            return $this->respondWithToken($token, 'foreman');
        } elseif ($token = Auth::guard('subforeman')->attempt($request->all())) {
            return $this->respondWithToken($token, 'subforeman');
        }
        return res(false, 401, 'Unauthorized, invalid email or password');
    }

    public function logout() {
        // return 'p';
        if (Auth::guard('foreman')->check()) {
            Auth::guard('foreman')->logout();
        }
        if (Auth::guard('subforeman')->check()) {
            Auth::guard('subforeman')->logout();
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
