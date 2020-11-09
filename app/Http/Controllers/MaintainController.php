<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\Afdelling;
use App\Models\Block;
use App\Models\Area;
use App\Models\Maintain\RkhMaintain;
use App\Models\Maintain\RkhHarvestMaintain;
use App\Models\Maintain\RkhSprayingMaintain;
use App\Models\Maintain\RkhManualMaintain;
use App\Models\Maintain\HarvestMaintain;
use App\Models\Maintain\SprayingMaintain;
use App\Models\Maintain\ManualMaintain;

class MaintainController extends Controller
{
    public function index() {
        $farms = Farm::all();
        $afdellings = Afdelling::all();
        $blocks = Block::all();
        return view('maintain.index', [
            'farms'      => $farms,
            'afdellings' => $afdellings,
            'blocks'     => $blocks
        ]);
    }

    public function filter(Request $request) {

        $area = Area::where('farm_id', $request->farm)
                    ->where('afdelling_id', $request->afdelling)
                    ->where('block_id', $request->block)
                    ->first();

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
            $rkh_harvest_maintain = RkhHarvestMaintain::where('rkh_maintain_id', $rkhm_id)->first();
            $harvest_amount_allocation = $rkh_harvest_maintain->fertilizer_amount;
            $harvest_amount_used = HarvestMaintain::where('rkh_maintain_id', $rkhm_id)->sum('amount_used');
            $harvest_completeness = $harvest_amount_used / $harvest_amount_allocation * 100;
            $total_harvest_completeness += $harvest_completeness;

            // Harvest Coverage
            $harvest_coverage = HarvestMaintain::where('rkh_maintain_id', $rkhm_id)->sum('coverage');
            $harvest_coverage_final = $harvest_coverage / $rkhm_coverage * 100;
            $total_harvest_coverage_final += $harvest_coverage_final;

            // Spraying amount used
            $rkh_spraying_maintain = RkhSprayingMaintain::where('rkh_maintain_id', $rkhm_id)->first();
            $spraying_amount_allocation = $rkh_spraying_maintain->spraying_amount;
            $spraying_amount_used = SprayingMaintain::where('rkh_maintain_id', $rkhm_id)->sum('amount_used');
            $spraying_completeness = $spraying_amount_used / $spraying_amount_allocation * 100;
            $total_spraying_completeness += $spraying_completeness;

            // Spraying coverage
            $spraying_coverage = SprayingMaintain::where('rkh_maintain_id', $rkhm_id)->sum('coverage');
            $spraying_coverage_final = $spraying_coverage / $rkhm_coverage * 100;
            $total_spraying_coverage_final += $spraying_coverage_final;

            $rkh_manual_maintain = RkhManualMaintain::where('rkh_maintain_id', $rkhm_id)->first();
            $manual_maintain = ManualMaintain::where('rkh_maintain_id', $rkhm_id);

            // Manual Circle
            $circle_allocation = $rkh_manual_maintain->circle;
            $circle_used = $manual_maintain->sum('circle');
            $circle_completeness = $circle_used / $circle_allocation * 100;
            $total_circle_completeness += $circle_completeness;

            // Manual Circle Coverage
            $circle_coverage = $manual_maintain->sum('circle_coverage');
            $circle_coverage_final = $circle_coverage / $rkhm_coverage * 100;
            $total_circle_coverage_final += $circle_coverage_final;

            // Manual Pruning
            $pruning_allocation = $rkh_manual_maintain->pruning;
            $pruning_used = $manual_maintain->sum('pruning');
            $pruning_completeness = $pruning_used / $pruning_allocation * 100;
            $total_pruning_completeness += $pruning_completeness;
            
            //Manual Pruning Coverage
            $pruning_coverage = $manual_maintain->sum('pruning_coverage');
            $pruning_coverage_final = $pruning_coverage / $rkhm_coverage * 100;
            $total_pruning_coverage_final += $pruning_coverage_final;

            // manual gawangan
            $gawangan_allocation = $rkh_manual_maintain->gawangan;
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

        // return view('maintain.index', [
        //     'aa' => 'dadah'
        // ]);

    }
}
