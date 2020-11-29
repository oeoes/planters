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
            'password' => Hash::make($request->password),
        ]);

        return back()->withSuccess('Foreman 1 created!');
    }

    public function update (Request $request, Foreman1 $foreman1) {
        $foreman1->update([
            'name' => $request->foreman1,
            'email' => $request->email,
            'role' => 1,
            'password' => Hash::make($request->password),
        ]);
        return back();
    }

    public function delete (Foreman1 $foreman1) {
        $foreman1->delete();
        return back();
    }
}
