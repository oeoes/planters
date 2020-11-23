<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foreman2;

class Foreman2Controller extends Controller
{
    public function index() {
        $foremans1 = Foreman2::orderByDesc('created_at')->get();
        return view('foreman2.index', [
            'foremans2' => $foremans1
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'foreman2' => 'required',
        ]);

        Foreman2::create([
            'name' => $request->foreman2,
            'email' => $request->email,
            'role' => 1,
            'password' => bcrypt($request->password), // password
        ]);

        return back()->withSuccess('Foreman 2 created!');
    }
}
