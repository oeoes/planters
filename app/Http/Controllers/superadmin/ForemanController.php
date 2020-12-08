<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Foreman;
use App\Models\Afdelling;

class ForemanController extends Controller
{
    public function index() {
        $foremans = Foreman::orderByDesc('created_at')->get();
        $afdellings = Afdelling::all();

        return view('superadmin.users.foreman.index', [
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
            'password' => Hash::make($request->password),
        ]);

        return back()->withSuccess('Foreman 1 created!');
    }

    public function update (Request $request, Foreman $foreman) {
        $foreman->update([
            'name' => $request->foreman,
            'email' => $request->email,
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
