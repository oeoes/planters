<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\Afdelling;
use App\Models\Block;
use App\Models\Area;
use App\Models\Harvesting\FruitHarvesting;
use App\Models\Harvesting\RkhHarvesting;

class HarvestingController extends Controller
{
    public function index() {
        $harvestings = RkhHarvesting::orderBy('date', 'DESC')->get();
        return view('harvesting.index', [
            'harvestings' => $harvestings
        ]);
    }

    public function filter_form() {
        $farms = Farm::all();
        return view('harvesting.filtering', [
            'farms'      => $farms,
        ]);
    }

    public function filter_process(Request $request) {
        $farm      = Farm::find($request->farm);
        $afdelling = Afdelling::find($request->afdelling);
        $block     = Block::find($request->block);

        $rkh_harvesting = RkhHarvesting::where('active', 0);
        
        if ($request->farm != 0 && $request->afdelling != 0 && $request->block != 0) {

            $rkh_harvesting = $rkh_harvesting->where('farm_id', $request->farm)
                                             ->where('afdelling_id', $request->afdelling)
                                             ->where('block_id', $request->block);

        } elseif ($request->farm != 0 && $request->afdelling != 0 && $request->block == 0) {

            $rkh_harvesting = $rkh_harvesting->where('farm_id', $request->farm)
                                             ->where('afdelling_id', $request->afdelling);

        } elseif ($request->farm != 0 && $request->afdelling == 0 && $request->block == 0) {

            $rkh_harvesting = $rkh_harvesting->where('farm_id', $request->farm);

        }
        $rkh_harvesting = $rkh_harvesting->whereBetween('date', [$request->date_start, $request->date_end])->get();

        $harvestings = $rkh_harvesting->toArray();
        
        if ($rkh_harvesting->isEmpty()) 
            return back()->withError('Rencana Kerja Harian Panen tidak ditemukan');

        $results = [];
        foreach ($harvestings as $key => $value) {
            $hvsid = $value['id'];
            $feeds = FruitHarvesting::where('rkh_harvesting_id', $hvsid);

            $employees_allocation = $value['employees_number'];

            // 1 rkh = 1 employee
            $employees_used = $feeds->get()->count();
            $employees_percentage_per_block = $employees_used / $employees_allocation * 100;

            $total_harvest_production_per_block = $feeds->sum('harvest_amount');

            $harvest_completeness  = 0;
            $harvest_total_minutes = 0;
            foreach ($feeds->get()->toArray() as $fkey => $fvalue) {
                // Calculating target harvesting
                $harvest_amount = $fvalue['harvest_amount'];
                $harvest_target = $fvalue['harvest_target'];
                $completeness = $harvest_amount / $harvest_target;
                $harvest_completeness += $completeness;

                // Calculating time
                $harvesting_time_start = strtotime($fvalue['time_start']);
                $harvesting_time_end   = strtotime($fvalue['time_end']);
                $harvest_in_minutes = round(abs($harvesting_time_end - $harvesting_time_start) / 60, 2);
                $harvest_total_minutes += $harvest_in_minutes;
            }

            $harvest_completeness_per_block = ($harvest_completeness / $feeds->get()->count()) * 100;

            $results [] = [
                'employee_used' => $employees_used,
                'employee_allocation' => $employees_allocation,
                'employee_percentage' => $employees_percentage_per_block,
                'total_harvest_production' => $total_harvest_production_per_block,
                'harvest_completeness' => $harvest_completeness,
                'harvest_total_minutes' => $harvest_total_minutes
            ];

            return back()->with([
                'request' => $request->all(),
                'data' => $results
            ]);
            
        }
    }
}
