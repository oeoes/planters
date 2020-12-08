<?php

namespace App\Http\Controllers\assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('assistant.dashboard.index');
    }
}
