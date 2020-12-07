<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\BlockReference;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $blockref = BlockReference::all();
        return view('superadmin.dashboard.index');
    }


}
