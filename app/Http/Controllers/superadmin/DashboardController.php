<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\BlockReference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        $blockref = BlockReference::select('planting_year', DB::raw("sum('total_coverage')"))
                                 ->groupBy('planting_year')
                                 ->get();
        dd($blockref->toArray());
        return view('superadmin.dashboard.index');
    }


}
