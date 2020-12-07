<?php

namespace App\Http\Controllers\assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Afdelling;
use App\Models\Subforeman;
use App\Models\JobType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SubforemanController extends Controller
{
    public function index() {
        $farm_af = DB::table('farms')
                    ->join('afdellings', 'farms.id', '=', 'afdellings.farm_id')
                    ->where('afdellings.id', auth()->guard()->user()->afdelling_id)
                    ->select('afdellings.id as afdelling_id', 'afdellings.name as afdelling', 'farms.name as farm')
                    ->first();
        $job_types = JobType::all();
        $subforemans = DB::table('subforemans')
                        ->join('afdellings', 'afdellings.id', '=', 'subforemans.afdelling_id')
                        ->join('job_types', 'job_types.id', '=', 'subforemans.jobtype_id')
                        ->where('afdellings.id', auth()->guard('assistant')->user()->afdelling_id)
                        ->select('subforemans.*', 'afdellings.name as afdelling', 'afdellings.id as afdelling_id', 'job_types.name as job_type', 'job_types.id as jobtype_id')
                        ->get();

        return view('assistant.users.subforeman.index', [
            'subforemans' => $subforemans,
            'farm_af' => $farm_af,
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
            'afdelling_id' => auth()->guard('assistant')->user()->afdelling_id,
            'jobtype_id' => $request->jobtype_id,
            'password' => Hash::make($request->password),
        ]);

        return back()->withSuccess('Sub foreman created!');
    }

    public function update (Request $request, SubForeman $subforeman) {
        $subforeman->update([
            'name' => $request->subforeman,
            'email' => $request->email,
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
