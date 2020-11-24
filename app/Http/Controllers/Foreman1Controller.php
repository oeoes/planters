<?php

namespace App\Http\Controllers;

use App\Models\Foreman1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Foreman1Controller extends Controller
{
    public function index() {
        $foremans1 = Foreman1::orderByDesc('created_at')->get();
        return view('users.foreman1.index', [
            'foremans1' => $foremans1
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'foreman1' => 'required',
        ]);

        Foreman1::create([
            'name' => $request->foreman1,
            'email' => $request->email,
            'role' => 1,
            'password' => Hash::make($request->password), // password
        ]);

        return back()->withSuccess('Foreman 1 created!');
    }
}
