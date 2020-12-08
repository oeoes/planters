<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HarvestingController extends Controller
{
    public function index () {
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
        return view('superadmin.harvesting.index')->with(['harvestings' => $harvestings]);
    }
}
