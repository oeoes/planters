<?php

namespace App\Http\Controllers;

use App\Models\Foreman1;
use Illuminate\Http\Request;

class Foreman1Controller extends Controller
{
    public function index() {
        $foremans1 = Foreman1::orderByDesc('created_at')->get();
        return view('foreman1.index', [
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
            'password' => bcrypt($request->password), // password
        ]);

        return back()->withSuccess('Foreman 1 created!');
    }
}
