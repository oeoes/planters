<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\Afdelling;
use App\Models\Block;
use App\Models\Area;
use App\Models\Maintain\CircleType;
use App\Models\Maintain\FertilizerType;
use App\Models\Maintain\GawanganType;
use App\Models\Maintain\PestControl;
use App\Models\Maintain\PruningType;
use App\Models\Maintain\SprayingType;

class MaintainController extends Controller
{
    public function index() {
        $sprayings = SprayingType::all();
        $fertilizers = FertilizerType::all();
        $pestcontrols = PestControl::all();
        $circles = CircleType::all();
        $prunings = PruningType::all();
        $gawangans = GawanganType::all();
        $arr = $sprayings->merge($sprayings);
        dd($arr);
    }

    public function filter1(Request $request) {
        $area = Area::where('farm_id', $request->farm)->where('afdelling_id', $request->afdelling)->where('block_id', $request->block)->first();

        $farm = Farm::find($request->farm)->name;
        $afdelling = Afdelling::find($request->afdelling)->name;
        $block = Block::find($request->block)->name;

        $area_id  = $area->id;
        $rkh_maintains = RkhMaintain::where('area_id', $area_id)->get(); // area_id = 1;

        $total_harvest_completeness    = 0;
        $total_harvest_coverage_final  = 0;
        $total_spraying_completeness   = 0;
        $total_spraying_coverage_final = 0;
        $total_circle_completeness     = 0;
        $total_circle_coverage_final   = 0;
        $total_pruning_completeness    = 0;
        $total_pruning_coverage_final  = 0;
        $total_gawangan_completeness   = 0;
        $rkh_length = count($rkh_maintains);

        foreach ($rkh_maintains as $rkh_maintain) {
            $rkhm_id = $rkh_maintain->id;
            $rkhm_coverage = $rkh_maintain->coverage;

            // Harvest Amount Used
            $rkh_harvest_maintain = RkhMaintain::where('rkh_maintain_id', $rkhm_id)->first();
            $harvest_amount_allocation = $rkh_harvest_maintain->fertilizer_amount;
            $harvest_amount_used = $harvest_spraying->sum('harvest_amount');
            $harvest_completeness = $harvest_amount_used / $harvest_amount_allocation * 100;
            $total_harvest_completeness += $harvest_completeness;

            // Harvest Coverage
            $harvest_coverage = HarvestSpraying::where('rkh_maintain_id', $rkhm_id)->sum('harvest_coverage');
            $harvest_coverage_final = $harvest_coverage / $rkhm_coverage * 100;
            $total_harvest_coverage_final += $harvest_coverage_final;

            // Spraying amount used
            $rkh_spraying_maintain = RkhMaintain::where('rkh_maintain_id', $rkhm_id)->first();
            $spraying_amount_allocation = $rkh_spraying_maintain->spraying_amount;
            $spraying_amount_used = HarvestSpraying::where('rkh_maintain_id', $rkhm_id)->sum('spraying_amount');
            $spraying_completeness = $spraying_amount_used / $spraying_amount_allocation * 100;
            $total_spraying_completeness += $spraying_completeness;

            // Spraying coverage
            $spraying_coverage = HarvestSpraying::where('rkh_maintain_id', $rkhm_id)->sum('spraying_coverage');
            $spraying_coverage_final = $spraying_coverage / $rkhm_coverage * 100;
            $total_spraying_coverage_final += $spraying_coverage_final;

            $rkh_maintain = RkhMaintain::where('rkh_maintain_id', $rkhm_id)->first();
            $manual_maintain = ManualMaintain::where('rkh_maintain_id', $rkhm_id)->get();

            // Manual Circle
            $circle_allocation = $rkh_maintain->circle;
            $circle_used = $manual_maintain->sum('circle');
            $circle_completeness = $circle_used / $circle_allocation * 100;
            $total_circle_completeness += $circle_completeness;

            // Manual Circle Coverage
            $circle_coverage = $manual_maintain->sum('circle_coverage');
            $circle_coverage_final = $circle_coverage / $rkhm_coverage * 100;
            $total_circle_coverage_final += $circle_coverage_final;

            // Manual Pruning
            $pruning_allocation = $rkh_maintain->pruning;
            $pruning_used = $manual_maintain->sum('pruning');
            $pruning_completeness = $pruning_used / $pruning_allocation * 100;
            $total_pruning_completeness += $pruning_completeness;
            
            //Manual Pruning Coverage
            $pruning_coverage = $manual_maintain->sum('pruning_coverage');
            $pruning_coverage_final = $pruning_coverage / $rkhm_coverage * 100;
            $total_pruning_coverage_final += $pruning_coverage_final;

            // manual gawangan
            $gawangan_allocation = $rkh_maintain->gawangan;
            $gawangan_used = $manual_maintain->sum('gawangan');
            $gawangan_completeness = $gawangan_used / $gawangan_allocation * 100;
            $total_gawangan_completeness += $gawangan_completeness;
            
        }

        $total_harvest_completeness    /= $rkh_length;
        $total_harvest_coverage_final  /= $rkh_length;
        $total_spraying_completeness   /= $rkh_length;
        $total_spraying_coverage_final /= $rkh_length;
        $total_circle_completeness     /= $rkh_length;
        $total_circle_coverage_final   /= $rkh_length;
        $total_pruning_completeness    /= $rkh_length;
        $total_pruning_coverage_final  /= $rkh_length;
        $total_gawangan_completeness   /= $rkh_length;

        $data = [
            'farm' => $farm,
            'afdelling' => $afdelling,
            'block' => $block,
            'total_harvest_completeness'   => $total_gawangan_completeness,
            'total_harvest_coverage_final' => $total_harvest_coverage_final,
            'total_spraying_completeness'  => $total_spraying_completeness,
            'total_spraying_coverage_final'=> $total_spraying_coverage_final,
            'total_circle_completeness'    => $total_circle_completeness,
            'total_circle_coverage_final'  => $total_circle_coverage_final,
            'total_pruning_completeness'   => $total_pruning_completeness,
            'total_pruning_coverage_final' => $total_pruning_coverage_final,
            'total_gawangan_completeness'  => $total_gawangan_completeness,
        ];

        return back()->with([
            'data' => $data
        ]);

    }

    public function filter(Request $request) {
        $area = Area::where('farm_id', $request->farm)->where('afdelling_id', $request->afdelling)->where('block_id', $request->block)->first();

        $farm = Farm::find($request->farm);
        $afdelling = Afdelling::find($request->afdelling);
        $block = Block::find($request->block);

        $area_id  = $area->id;
        $rkh_maintain = RkhMaintain::where('area_id', $area_id)
                        ->where('period', $request->period)
                        ->where('planting_year', $request->pyear)
                        ->first();
                        
        if (! $rkh_maintain) 
            return back()->withError('There is not daily work plan');


        $rkhm_id = $rkh_maintain->id;
        $rkhm_coverage = $rkh_maintain->coverage;
        $harvest_spraying = HarvestSpraying::where('rkh_maintain_id', $rkhm_id);
        $manual_maintain  = ManualMaintain::where('rkh_maintain_id', $rkhm_id);

            // Harvest Amount Used
            $harvest_amount_allocation = $rkh_maintain->fertilizer_amount;
            $harvest_amount_used = $harvest_spraying->sum('harvest_amount');
            $harvest_completeness = $harvest_amount_used / $harvest_amount_allocation * 100;

            // Harvest Coverage
            $harvest_coverage = $harvest_spraying->sum('harvest_coverage');
            $harvest_coverage_final = $harvest_coverage / $rkhm_coverage * 100;

            // Spraying amount used
            $spraying_amount_allocation = $rkh_maintain->spraying_amount;
            $spraying_amount_used = $harvest_spraying->sum('spraying_amount');
            $spraying_completeness = $spraying_amount_used / $spraying_amount_allocation * 100;

            // Spraying coverage
            $spraying_coverage = $harvest_spraying->sum('spraying_coverage');
            $spraying_coverage_final = $spraying_coverage / $rkhm_coverage * 100;


            // Manual Circle
            $circle_allocation = $rkh_maintain->manual_circle;
            $circle_used = $manual_maintain->sum('circle');
            $circle_completeness = $circle_used / $circle_allocation * 100;

            // Manual Circle Coverage
            $circle_coverage = $manual_maintain->sum('circle_coverage');
            $circle_coverage_final = $circle_coverage / $rkhm_coverage * 100;

            // Manual Pruning
            $pruning_allocation = $rkh_maintain->manual_pruning;
            $pruning_used = $manual_maintain->sum('pruning');
            $pruning_completeness = $pruning_used / $pruning_allocation * 100;
            
            //Manual Pruning Coverage
            $pruning_coverage = $manual_maintain->sum('pruning_coverage');
            $pruning_coverage_final = $pruning_coverage / $rkhm_coverage * 100;

            // manual gawangan
            $gawangan_allocation = $rkh_maintain->manual_gawangan;
            $gawangan_used = $manual_maintain->sum('gawangan');
            $gawangan_completeness = $gawangan_used / $gawangan_allocation * 100;

        $data = [
            'farm' => $farm->name,
            'afdelling' => $afdelling->name,
            'block' => $block->name,
            'rkh_coverage' => $rkhm_coverage,
            'period' => $request->period,
            'planting_year' => $request->pyear,

            'total_harvest_completeness'   => $gawangan_completeness,
            'total_harvest_coverage_final' => $harvest_coverage_final,
            'total_spraying_completeness'  => $spraying_completeness,
            'total_spraying_coverage_final'=> $spraying_coverage_final,
            'total_circle_completeness'    => $circle_completeness,
            'total_circle_coverage_final'  => $circle_coverage_final,
            'total_pruning_completeness'   => $pruning_completeness,
            'total_pruning_coverage_final' => $pruning_coverage_final,
            'total_gawangan_completeness'  => $gawangan_completeness,

            'harvest_amount_allocation' => $harvest_amount_allocation,
            'harvest_amount_used'       => (int) $harvest_amount_used,
            'harvest_coverage'          => $harvest_coverage,
            
            'spraying_amount_allocation' => $spraying_amount_allocation,
            'spraying_amount_used'       => $spraying_amount_used,
            'spraying_coverage'          => $spraying_coverage,
    
            'circle_allocation' => $circle_allocation,
            'circle_used'       => $circle_used,
            'circle_coverage'   => $circle_coverage,
            
            'pruning_allocation' => $pruning_allocation,
            'pruning_used'       => $pruning_used,
            'pruning_coverage'   => $pruning_coverage,
            
            'gawangan_allocation' => $gawangan_allocation,
            'gawangan_used'       => $gawangan_used

        ];

        return back()->with([
            'data' => $data
        ]);

    }

    public function spraying() {
        return view('maintain.spraying');
    }
}
