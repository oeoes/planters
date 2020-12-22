<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\Assistant;
use Illuminate\Http\Request;

class AssistantController extends Controller
{
    public function store(Request $request)
    {
        Assistant::create([
            'name' => $request->name,
            'email' => $request->email,
            'afdelling_id' => $request->afdelling_id,
            'password' => bcrypt($request->password),
        ]);
        return back()->withSuccess('Assistant added');
    }
}
