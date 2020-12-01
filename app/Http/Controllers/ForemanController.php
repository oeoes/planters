<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foreman;
use App\Models\Afdelling;
use Illuminate\Support\Facades\Hash;

class ForemanController extends Controller
{
    public function index() {
        $foremans = Foreman::orderByDesc('created_at')->get();
        $afdellings = Afdelling::all();

        return view('users.foreman.index', [
            'foremans' => $foremans,
            'afdellings' => $afdellings,
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'foreman' => 'required',
        ]);

        Foreman::create([
            'name' => $request->foreman,
            'email' => $request->email,
            'afdelling_id' => $request->afdelling_id,
            'role' => 1,
            'password' => Hash::make($request->password),
        ]);

        return back()->withSuccess('Foreman 1 created!');
    }

    public function update (Request $request, Foreman $foreman) {
        $foreman->update([
            'name' => $request->foreman,
            'email' => $request->email,
            'role' => 1,
            'afdelling_id' => $request->afdelling_id,
            'password' => Hash::make($request->password),
        ]);
        return back();
    }

    public function delete (Foreman $foreman) {
        $foreman->delete();
        return back();
    }
}
