<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Afdelling;
use App\Models\Subforeman;
use App\Models\Farm;
use App\Models\JobType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SubforemanController extends Controller
{
    public function index() {
        $aff = Afdelling::find(auth()->guard('farmmanager')->user()->afdelling_id);
        $farm_af = Farm::find($aff->farm_id);
        $afdellings = DB::table('afdellings')
                    ->leftJoin('farms', 'afdellings.farm_id', '=', 'farms.id')
                    ->where('farms.id', '=', $farm_af->id)
                    ->select('afdellings.*')->get();

        $job_types = JobType::all();
        $subforemans = DB::table('farms')
                        ->join('afdellings', 'farms.id', '=', 'afdellings.farm_id')
                        ->join('subforemans', 'afdellings.id', '=', 'subforemans.afdelling_id')
                        ->join('job_types', 'job_types.id', '=', 'subforemans.jobtype_id')
                        ->where('farms.id', $aff->farm_id)
                        ->select('subforemans.*', 'afdellings.name as afdelling', 'afdellings.id as afdelling_id', 'job_types.name as job_type', 'job_types.id as jobtype_id')
                        ->get();

        return view('manager.users.subforeman.index', [
            'subforemans' => $subforemans,
            'farm_af' => $farm_af,
            'afdellings' => $afdellings,
            'job_types' => $job_types
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'subforeman' => 'required',
        ]);

        Subforeman::create([
            'name' => $request->subforeman,
            'email' => $request->email,
            'afdelling_id' => $request->afdelling_id,
            'jobtype_id' => $request->jobtype_id,
            'password' => Hash::make($request->password),
        ]);

        return back()->withSuccess('Sub foreman created!');
    }

    public function update (Request $request, SubForeman $subforeman) {
        $subforeman->update([
            'name' => $request->subforeman,
            'email' => $request->email,
            'afdelling_id' => $request->afdelling_id,
            'jobtype_id' => $request->jobtype_id,
            'password' => Hash::make($request->password),
        ]);
        return back();
    }

    public function delete (SubForeman $subforeman) {
        $subforeman->delete();
        return back();
    }
}
