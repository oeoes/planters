<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RkhMaintainRequest;

class RkhMaintainController extends Controller
{
    public function index() {
        
    }

    public function rawat () {
        return view('assistant.rawat');
    }

    public function store (RkhMaintainRequest $request) {
        dd($request->all());
    }

}
