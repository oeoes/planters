<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Foreman;
use App\Models\Farm;
use App\Models\Afdelling;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ForemanController extends Controller
{
    public function index() {
        $aff = Afdelling::find(auth()->guard('farmmanager')->user()->afdelling_id);
        $farm_af = Farm::find($aff->farm_id);
        $afdellings = DB::table('afdellings')
                    ->leftJoin('farms', 'afdellings.farm_id', '=', 'farms.id')
                    ->where('farms.id', '=', $farm_af->id)
                    ->select('afdellings.*')->get();
        $foremans = DB::table('farms')
                ->join('afdellings', 'farms.id', '=', 'afdellings.farm_id')
                ->join('foremans', 'afdellings.id', '=', 'foremans.afdelling_id')
                ->select('foremans.*', 'afdellings.name as afdelling', 'afdellings.id as afdelling_id', 'farms.name as farm', 'farms.id as farm_id')
                ->where('farms.id', $farm_af->id)
                ->get();

        return view('manager.users.foreman.index', [
            'foremans' => $foremans,
            'farm_af' => $farm_af,
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
