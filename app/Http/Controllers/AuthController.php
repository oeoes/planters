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
        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (Auth::guard('assistant')->attempt($credentials)) {

            return redirect('/assistant/dashboard/');

        } else if (Auth::guard('superadmin')->attempt($credentials)) {
            
            return redirect('/superadmin/dashboard/');

        } else if (Auth::guard('farmmanager')->attempt($credentials)) {

            return redirect('/farmmanager/dashboard/');

        } else {

            return back();

        }
    }

    public function logout() {
        if (Auth::guard('assistant')->check()) {
            Auth::guard('assistant')->logout();
            return redirect('/login');
        }

        if (Auth::guard('farmmanager')->check()) {
            Auth::guard('farmmanager')->logout();
            return redirect('/login');
        }

        if (Auth::guard('superadmin')->check()) {
            Auth::guard('superadmin')->logout();
            return redirect('/login');
        }

    }
}
