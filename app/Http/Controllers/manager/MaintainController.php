<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maintain\SprayingType;
use Illuminate\Support\Facades\DB;

class MaintainController extends Controller
{
    public function spraying () {
        $sprayings = DB::table('block_references')
                ->leftJoin('sprayings', 'sprayings.block_ref_id', '=', 'block_references.id')
                ->leftJoin('fill_sprayings', 'fill_sprayings.spraying_id', '=', 'sprayings.id')
                ->leftJoin('foremans', 'foremans.id', '=', 'sprayings.foreman_id')
                ->leftJoin('subforemans', 'subforemans.id', '=', 'sprayings.subforeman_id')
                ->leftJoin('job_types', 'job_types.id', '=', 'block_references.jobtype_id')
                ->leftJoin('blocks', 'blocks.id', '=', 'block_references.block_id')
                ->select('block_references.foreman_id', 'sprayings.subforeman_id', 'sprayings.date', 'block_references.planting_year', 'block_references.total_coverage', 'block_references.available_coverage', 'block_references.population_coverage', 'block_references.population_perblock', 'blocks.code as block', 'foremans.name as foreman', 'subforemans.name as subforeman', 'job_types.name as job_type')
                ->where('block_references.jobtype_id', 1)
                ->get();
        return view('superadmin.maintain.spraying')->with(['sprayings' => $sprayings]);
    }

    public function fertilizer () {
        $fertilizers = DB::table('block_references')
                ->leftJoin('fertilizers', 'fertilizers.block_ref_id', '=', 'block_references.id')
                ->leftJoin('fill_fertilizers', 'fill_fertilizers.fertilizer_id', '=', 'fertilizers.id')
                ->leftJoin('foremans', 'foremans.id', '=', 'fertilizers.foreman_id')
                ->leftJoin('subforemans', 'subforemans.id', '=', 'fertilizers.subforeman_id')
                ->leftJoin('job_types', 'job_types.id', '=', 'block_references.jobtype_id')
                ->leftJoin('blocks', 'blocks.id', '=', 'block_references.block_id')
                ->select('block_references.foreman_id', 'fertilizers.subforeman_id', 'fertilizers.date', 'block_references.planting_year', 'block_references.total_coverage', 'block_references.available_coverage', 'block_references.population_coverage', 'block_references.population_perblock', 'blocks.code as block', 'foremans.name as foreman', 'subforemans.name as subforeman', 'job_types.name as job_type')
                ->where('block_references.jobtype_id', 2)
                ->get();
        return view('superadmin.maintain.fertilizer')->with(['fertilizers' => $fertilizers]);
    }

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
                ->get();
        return view('superadmin.maintain.circle')->with(['circles' => $circles]);
    }

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
                ->get();
        return view('superadmin.maintain.pruning')->with(['prunings' => $prunings]);
    }

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
                ->get();
        return view('superadmin.maintain.gawangan')->with(['gawangans' => $gawangans]);
    }

    public function pestcontrol () {
        $pest_controls = DB::table('block_references')
                ->leftJoin('pest_controls', 'pest_controls.block_ref_id', '=', 'block_references.id')
                ->leftJoin('fill_pcontrols', 'fill_pcontrols.pcontrol_id', '=', 'pest_controls.id')
                ->leftJoin('foremans', 'foremans.id', '=', 'pest_controls.foreman_id')
                ->leftJoin('subforemans', 'subforemans.id', '=', 'pest_controls.subforeman_id')
                ->leftJoin('job_types', 'job_types.id', '=', 'block_references.jobtype_id')
                ->leftJoin('blocks', 'blocks.id', '=', 'block_references.block_id')
                ->select('block_references.foreman_id', 'pest_controls.subforeman_id', 'pest_controls.date', 'block_references.planting_year', 'block_references.total_coverage', 'block_references.available_coverage', 'block_references.population_coverage', 'block_references.population_perblock', 'blocks.code as block', 'foremans.name as foreman', 'subforemans.name as subforeman', 'job_types.name as job_type')
                ->where('block_references.jobtype_id', 6)
                ->get();
        return view('superadmin.maintain.pest-control')->with(['pest_controls' => $pest_controls]);
    }
}
