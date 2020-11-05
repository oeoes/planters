<?php

namespace App\Http\Controllers;

use App\Http\Requests\Web\LoginSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{
    public function index() {
        return view('login');
    }

    public function process(LoginSession $request) {
        $request->validated();
        $data = [
            'email' => $request->email, 
            'password' => $request->password
        ];

        if (Auth::guard('assistant')->attempt($data)) {
          return redirect()->intended('/assistant');
        }
        
        toast('Email atau Password salah', 'error');
        return back();
    }

    public function logout() {
        Auth::guard('assistant')->logout();
        toast('Logout berhasil', 'success');
        return redirect('/');
    }
}
