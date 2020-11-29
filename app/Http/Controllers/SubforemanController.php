<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubForeman;
use Illuminate\Support\Facades\Hash;

class SubforemanController extends Controller
{
    public function index() {
        $subforemans = SubForeman::orderByDesc('created_at')->get();
        return view('users.subforeman.index', [
            'subforemans' => $subforemans
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'subforeman' => 'required',
        ]);

        SubForeman::create([
            'name' => $request->subforeman,
            'email' => $request->email,
            'afdelling_id' => $request->afdelling_id,
            'jobtype_id' => $request->jobtype_id,
            'role' => 1,
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
            'role' => 1,
            'password' => Hash::make($request->password),
        ]);
        return back();
    }

    public function delete (SubForeman $subforeman) {
        $subforeman->delete();
        return back();
    }
}
