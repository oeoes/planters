<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\BlockReference;
use App\Models\Maintain\FertilizerType;
use App\Models\Maintain\PestControl;
use App\Models\Maintain\CircleType;
use App\Models\Maintain\PruningType;
use App\Models\Maintain\GawanganType;
use App\Models\Harvesting\HarvestingType;
use App\Models\Maintain\SprayingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypejobController extends Controller
{
         // SPRAYING
         public function spraying () {
            $sprayings = SprayingType::all();
            return view('superadmin.type.spraying.index')->with([
                'sprayings' => $sprayings
            ]);
        }
    
        public function spraying_detail($blok_ref_id, $spraying_id) {
            $blok_reference = BlockReference::find($blok_ref_id);
            $spraying = $blok_reference->model::find($spraying_id);
            $fill = $blok_reference->fill::where($blok_reference->fill_id, $spraying_id)->first();
            return view('superadmin.type.spraying.detail')->with([
                'block_reference' => $blok_reference,
                'spraying'        => !$spraying ? null : $spraying,
                'fill'            => !$fill ? null : $fill,
            ]);
        }

        public function spraying_history() {
            $block_references = BlockReference::where('jobtype_id', 1)
                                            ->where('completed', 1)
                                            ->orderByDesc('created_at')
                                            ->get();
            return view('superadmin.type.spraying.history', [
                'block_references' => $block_references
            ]);
        }

        public function spraying_history_detail($block_ref_id) {
            $block_reference = BlockReference::find($block_ref_id);
            $seeds = $block_reference->model::where('block_ref_id', $block_ref_id)
                                            ->orderByDesc('created_at')
                                            ->get();
            $filled = [];
            foreach ($seeds as $key => $value) {
                $filled [] = [ 
                    $block_reference->fill::where($block_reference->fill_id, $value['id'])->first()->toArray()
                ];
            }

            return view('superadmin.type.spraying.history_detail', [
                'block_reference' => $block_reference,
                'seeds' => $seeds,
                'fills' => $filled
            ]);
        }
    
    
        // FERTILIZER
        public function fertilizer () {
            $fertilizers = FertilizerType::all();
            return view('superadmin.type.fertilizer.index')->with([
                'fertilizers' => $fertilizers
            ]);
        }

        public function fertilizer_detail($blok_ref_id, $fertilizer_id) {
            $blok_reference = BlockReference::find($blok_ref_id);
            $fertilizer = $blok_reference->model::find($fertilizer_id);
            $fill = $blok_reference->fill::where($blok_reference->fill_id, $fertilizer_id)->first();
            return view('superadmin.type.fertilizer.detail')->with([
                'block_reference' => $blok_reference,
                'fertilizer'        => !$fertilizer ? null : $fertilizer,
                'fill'            => !$fill ? null : $fill,
            ]);
        }
    
        // CIRCLE
        public function circle () {
            $circles = CircleType::all();
            return view('superadmin.type.circle.index')->with([
                'circles' => $circles
            ]);
        }

        public function circle_detail($blok_ref_id, $circle_id) {
            $blok_reference = BlockReference::find($blok_ref_id);
            $circle = $blok_reference->model::find($circle_id);
            $fill = $blok_reference->fill::where($blok_reference->fill_id, $circle_id)->first();
            return view('superadmin.type.circle.detail')->with([
                'block_reference' => $blok_reference,
                'circle'        => !$circle ? null : $circle,
                'fill'            => !$fill ? null : $fill,
            ]);
        }
    
        // PRUNING
        public function pruning () {
            $prunings = PruningType::all();
            return view('superadmin.type.pruning.index')->with([
                'prunings' => $prunings
            ]);
        }

        public function pruning_detail($blok_ref_id, $pruning_id) {
            $blok_reference = BlockReference::find($blok_ref_id);
            $pruning = $blok_reference->model::find($pruning_id);
            $fill = $blok_reference->fill::where($blok_reference->fill_id, $pruning_id)->first();
            return view('superadmin.type.pruning.detail')->with([
                'block_reference' => $blok_reference,
                'pruning'        => !$pruning ? null : $pruning,
                'fill'            => !$fill ? null : $fill,
            ]);
        }
    
        // GAWANGAN
        public function gawangan () {
            $gawangans = GawanganType::all();
            return view('superadmin.type.gawangan.index')->with([
                'gawangans' => $gawangans
            ]);
        }

        public function gawangan_detail($blok_ref_id, $gawangan_id) {
            $blok_reference = BlockReference::find($blok_ref_id);
            $gawangan = $blok_reference->model::find($gawangan_id);
            $fill = $blok_reference->fill::where($blok_reference->fill_id, $gawangan_id)->first();
            return view('superadmin.type.gawangan.detail')->with([
                'block_reference' => $blok_reference,
                'gawangan'        => !$gawangan ? null : $gawangan,
                'fill'            => !$fill ? null : $fill,
            ]);
        }
    
        // PEST CONTROL
        public function pestcontrol () {
            $pestcontrols = PestControl::all();
            return view('superadmin.type.pcontrol.index')->with([
                'pestcontrols' => $pestcontrols
            ]);
        }

        public function pestcontrol_detail($blok_ref_id, $pestcontrol_id) {
            $blok_reference = BlockReference::find($blok_ref_id);
            $pestcontrol = $blok_reference->model::find($pestcontrol_id);
            $fill = $blok_reference->fill::where($blok_reference->fill_id, $pestcontrol_id)->first();
            return view('superadmin.type.pcontrol.detail')->with([
                'block_reference' => $blok_reference,
                'pestcontrol'     => !$pestcontrol ? null : $pestcontrol,
                'fill'            => !$fill ? null : $fill,
            ]);
        }
    
        // HARVESTING
        public function harvesting () {
            $harvestings = HarvestingType::all();
            return view('superadmin.type.harvesting.index')->with([
                'harvestings' => $harvestings
            ]);
            return view('superadmin.type.harvesting.index')->with(['harvestings' => $harvestings]);
        }

        public function harvesting_detail ($blok_ref_id, $harvesting_id) {
            $blok_reference = BlockReference::find($blok_ref_id);
            $harvesting = $blok_reference->model::find($harvesting_id);
            $fill = $blok_reference->fill::where($blok_reference->fill_id, $harvesting_id)->first();
            return view('superadmin.type.harvesting.detail')->with([
                'block_reference' => $blok_reference,
                'harvesting'     => !$harvesting ? null : $harvesting,
                'fill'            => !$fill ? null : $fill,
            ]);
        }
}
