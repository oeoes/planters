<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginform() {
        return view('login');
    }

    public function authenticate(Request $request ) {
        if (Auth::guard('assistant')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('dashboard');
        } else {
            return back();
        }
    }

    public function logout() {
        Auth::guard('assistant')->logout();
        return redirect('/login');
    }
}
