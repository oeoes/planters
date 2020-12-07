<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\BlockReference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        $blockref = BlockReference::select('planting_year', DB::raw("sum(total_coverage) as coverage"))
                                 ->groupBy('planting_year')
                                 ->get();
        $coverage = [];
        $plantingyear = [];
        foreach ($blockref->toArray() as $key => $value) {
            $coverage [] = $value['coverage'];
            $plantingyear [] = $value['planting_year'];
        }
        $plantingyear = $blockref->implode('planting_year', ', ');
        $coverage     = $blockref->implode('coverage', ', ');

        return view('superadmin.dashboard.index', [
            'coverage' => $coverage,
            'plantingyear' => $plantingyear
        ]);
    }


}
