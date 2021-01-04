<?php

namespace App\Http\Controllers\assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HarvestingController extends Controller
{
    public function index () {
        return view('assistant.harvesting.index');
    }
}
