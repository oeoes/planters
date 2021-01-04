<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Assistant;
use Illuminate\Http\Request;
use App\Models\Farm;

class AssistantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assistants = Assistant::all();
        $farms = Farm::all();
        return view('superadmin.users.assistant.index', [
            'assistants' => $assistants,
            'farms' => $farms
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
