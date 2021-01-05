<?php

namespace App\Http\Controllers\assistant;

use App\Http\Controllers\Controller;
use App\Models\Harvesting\HarvestingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HarvestingController extends Controller
{
    public function index () {
        $afdelling_id = Auth::guard('assistant')->user()->afdelling_id;
        $harvestings = HarvestingType::where('afdelling_id', $afdelling_id)->orderByDesc('created_at')->get();
        $month = [
            "Januari", 
            "Februari", 
            "Maret", 
            "April", 
            "Mei", 
            "Juni", 
            "Juli", 
            "Agustus", 
            "September", 
            "Oktober", 
            "November", 
            "Desember"
        ];
        $actual_month = [];
        $sum = [];
        $lists = DB::table('fill_harvestings')->select(
            DB::raw('sum(total_harvesting) as data'), 
            DB::raw('MONTH(created_at) month')
        )->groupBy('month')->get();
        foreach ($lists as $key => $value) {
            $sum [] = $value->data;
            $actual_month [] = $month[$value->month - 1];
        }
        return view('assistant.harvesting.index', [
            'harvestings' => $harvestings,
            'sum' => json_encode($sum),
            'month' => json_encode($actual_month)
        ]);
    }

    public function detail ($harvesting_id) {
        $harvesting = HarvestingType::find($harvesting_id);
        return view('assistant.harvesting.details', [
            'harvesting' => $harvesting
        ]);
    }
}
