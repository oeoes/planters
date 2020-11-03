<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginSession;
use Illuminate\Http\Request;
use Auth;

class ManualAuthenticateUserController extends Controller
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
        //  elseif (Auth::guard('md1')->attempt($data)) {
        //   return redirect()->intended('/md1');
        // } elseif (Auth::guard('md2')->attempt($data)) {
        //   return redirect()->intended('/md2');
        // }
        
        toast('Email atau Password salah', 'error');
        return back();
    }

    public function logout() {
        Auth::guard('assistant')->logout();
        // Auth::guard('md1')->logout();
        // Auth::guard('md2')->logout();

        toast('Logout berhasil', 'success');
        return redirect('/');
    }
}
