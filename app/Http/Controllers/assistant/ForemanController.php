<?php

namespace App\Http\Controllers\assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Foreman;
use App\Models\Afdelling;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ForemanController extends Controller
{
    public function index() {
        $foremans = Foreman::orderByDesc('created_at')->where('afdelling_id', auth()->guard()->user()->afdelling_id)->get();
        $farm_af = DB::table('farms')
                    ->join('afdellings', 'farms.id', '=', 'afdellings.farm_id')
                    ->where('afdellings.id', auth()->guard()->user()->afdelling_id)
                    ->select('afdellings.id as afdelling_id', 'afdellings.name as afdelling', 'farms.name as farm')
                    ->first();

        return view('assistant.users.foreman.index', [
            'foremans' => $foremans,
            'farm_af' => $farm_af,
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
