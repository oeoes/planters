<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\BlockReference;
use App\Models\Maintain\FertilizerType;
use App\Models\Maintain\PestControl;
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
            $circles = DB::table('block_references')
                    ->leftJoin('circles', 'circles.block_ref_id', '=', 'block_references.id')
                    ->leftJoin('fill_circles', 'fill_circles.circle_id', '=', 'circles.id')
                    ->leftJoin('foremans', 'foremans.id', '=', 'circles.foreman_id')
                    ->leftJoin('subforemans', 'subforemans.id', '=', 'circles.subforeman_id')
                    ->leftJoin('job_types', 'job_types.id', '=', 'block_references.jobtype_id')
                    ->leftJoin('blocks', 'blocks.id', '=', 'block_references.block_id')
                    ->select('block_references.foreman_id', 'circles.subforeman_id', 'circles.date', 'block_references.planting_year', 'block_references.total_coverage', 'block_references.available_coverage', 'block_references.population_coverage', 'block_references.population_perblock', 'blocks.code as block', 'foremans.name as foreman', 'subforemans.name as subforeman', 'job_types.name as job_type')
                    ->where('block_references.jobtype_id', 3)
                    ->orderByDesc('circles.created_at')
                    ->get();
            return view('superadmin.type.circle.index')->with(['circles' => $circles]);
        }
    
        // PRUNING
        public function pruning () {
            $prunings = DB::table('block_references')
                    ->leftJoin('prunings', 'prunings.block_ref_id', '=', 'block_references.id')
                    ->leftJoin('fill_prunings', 'fill_prunings.pruning_id', '=', 'prunings.id')
                    ->leftJoin('foremans', 'foremans.id', '=', 'prunings.foreman_id')
                    ->leftJoin('subforemans', 'subforemans.id', '=', 'prunings.subforeman_id')
                    ->leftJoin('job_types', 'job_types.id', '=', 'block_references.jobtype_id')
                    ->leftJoin('blocks', 'blocks.id', '=', 'block_references.block_id')
                    ->select('block_references.foreman_id', 'prunings.subforeman_id', 'prunings.date', 'block_references.planting_year', 'block_references.total_coverage', 'block_references.available_coverage', 'block_references.population_coverage', 'block_references.population_perblock', 'blocks.code as block', 'foremans.name as foreman', 'subforemans.name as subforeman', 'job_types.name as job_type')
                    ->where('block_references.jobtype_id', 4)
                    ->orderByDesc('prunings.created_at')
                    ->get();
            return view('superadmin.type.pruning.index')->with(['prunings' => $prunings]);
        }
    
        // GAWANGAN
        public function gawangan () {
            $gawangans = DB::table('block_references')
                    ->leftJoin('gawangans', 'gawangans.block_ref_id', '=', 'block_references.id')
                    ->leftJoin('fill_gawangans', 'fill_gawangans.gawangan_id', '=', 'gawangans.id')
                    ->leftJoin('foremans', 'foremans.id', '=', 'gawangans.foreman_id')
                    ->leftJoin('subforemans', 'subforemans.id', '=', 'gawangans.subforeman_id')
                    ->leftJoin('job_types', 'job_types.id', '=', 'block_references.jobtype_id')
                    ->leftJoin('blocks', 'blocks.id', '=', 'block_references.block_id')
                    ->select('block_references.foreman_id', 'gawangans.subforeman_id', 'gawangans.date', 'block_references.planting_year', 'block_references.total_coverage', 'block_references.available_coverage', 'block_references.population_coverage', 'block_references.population_perblock', 'blocks.code as block', 'foremans.name as foreman', 'subforemans.name as subforeman', 'job_types.name as job_type')
                    ->where('block_references.jobtype_id', 5)
                    ->orderByDesc('gawangans.created_at')
                    ->get();
            return view('superadmin.type.gawangan.index')->with(['gawangans' => $gawangans]);
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
            $harvestings = DB::table('block_references')
                    ->leftJoin('harvestings', 'harvestings.block_ref_id', '=', 'block_references.id')
                    ->leftJoin('fill_harvestings', 'fill_harvestings.harvest_id', '=', 'harvestings.id')
                    ->leftJoin('foremans', 'foremans.id', '=', 'harvestings.foreman_id')
                    ->leftJoin('subforemans', 'subforemans.id', '=', 'harvestings.subforeman_id')
                    ->leftJoin('job_types', 'job_types.id', '=', 'block_references.jobtype_id')
                    ->leftJoin('blocks', 'blocks.id', '=', 'block_references.block_id')
                    ->select('block_references.foreman_id', 'harvestings.subforeman_id', 'harvestings.date', 'block_references.planting_year', 'block_references.total_coverage', 'block_references.available_coverage', 'block_references.population_coverage', 'block_references.population_perblock', 'blocks.code as block', 'foremans.name as foreman', 'subforemans.name as subforeman', 'job_types.name as job_type')
                    ->where('block_references.jobtype_id', 7)
                    ->get();
            return view('superadmin.type.harvesting.index')->with(['harvestings' => $harvestings]);
        }
}
