<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\Afdelling;
use App\Models\Block;
use App\Models\Area;
use App\Models\JobType;
use App\Models\BlockReference;
use App\Models\Foreman;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    public function job_type() {
        $job_types = JobType::all();
        return view('assistant.area.job_type.index', [
            'job_types' => $job_types
        ]);
    }

    public function job_type_store(Request $request) {
        JobType::create([
            'name' => $request->job_type
        ]);
        return back()->withSuccess('Job type created');
    }

    public function job_type_update (Request $request, JobType $job_type) {
        $job_type->update([
            'name' => $request->job_type
        ]);
        return back();
    }

    public function job_type_delete (JobType $job_type) {
        $job_type->delete();
        return back();
    }

    public function farm() {
        $farms = Farm::all();
        return view('assistant.area.farm.index', [
            'farms' => $farms
        ]);
    }

    public function farm_store(Request $request) {
        Farm::create([
            'name' => $request->farm
        ]);
        return back()->withSuccess('Farm created');
    }

    public function farm_update (Request $request, Farm $farm) {
        $farm->update([
            'name' => $request->farm
        ]);
        return back();
    }

    public function farm_delete (Farm $farm) {
        $farm->delete();
        return back();
    }

    public function afdelling() {
        $afdellings = DB::table('afdellings')
                    ->leftJoin('farms', 'afdellings.farm_id', '=', 'farms.id')
                    ->select('afdellings.*', 'farms.name as farm')->get();
        $farms = Farm::all();

        return view('assistant.area.afdelling.index', [
            'afdellings' => $afdellings, 
            'farms' => $farms
        ]);
    }

    public function afdelling_store(Request $request) {
        Afdelling::create([
            'name' => $request->afdelling,
            'farm_id' => $request->farm_id,
            'hk_total' => $request->hk_total,
        ]);
        return back()->withSuccess('Afdelling created');
    }

    public function afdelling_update (Request $request, Afdelling $afdelling) {
        $afdelling->update([
            'name' => $request->afdelling,
            'farm_id' => $request->farm_id,
            'hk_total' => $request->hk_total,
        ]);
        return back();
    }

    public function afdelling_delete (Afdelling $afdelling) {
        $afdelling->delete();
        return back();
    }

    public function block() {
        $blocks = DB::table('blocks')
                ->join('afdellings', 'afdellings.id', '=', 'blocks.afdelling_id')
                ->join('farms', 'farms.id', '=', 'afdellings.farm_id')
                ->select('blocks.*', 'afdellings.name as afdelling', 'afdellings.id as afdelling_id', 'farms.name as farm', 'farms.id as farm_id')
                ->get();
        $afdellings = Afdelling::all();

        return view('assistant.area.block.index', [
            'blocks' => $blocks,
            'afdellings' => $afdellings
        ]);
    }

    public function block_store(Request $request) {
        Block::create([
            'code' => $request->block,
            'afdelling_id' => $request->afdelling_id
        ]);
        return back()->withSuccess('block created');
    }

    public function block_update (Request $request, Block $block) {
        $block->update([
            'code' => $request->block,
            'afdelling_id' => $request->afdelling_id
        ]);
        return back();
    }

    public function block_delete (Block $block) {
        $block->delete();
        return back();
    }

    public function block_reference() {
        $block_references = DB::table('block_references')
                            ->join('blocks', 'blocks.id', '=', 'block_references.block_id')
                            ->join('afdellings', 'afdellings.id', '=', 'blocks.afdelling_id')
                            ->join('farms', 'farms.id', '=', 'afdellings.farm_id')
                            ->join('foremans', 'foremans.id', '=', 'block_references.foreman_id')
                            ->join('job_types', 'job_types.id', '=', 'block_references.jobtype_id')
                            ->select('block_references.*', 'blocks.code', 'blocks.id as block_id', 'afdellings.name as afdelling', 'farms.name as farm', 'foremans.name as foreman', 'foremans.id as foreman_id', 'job_types.name as job_type', 'job_types.id as jobtype_id')
                            ->get();
        $blocks = DB::table('blocks')
                ->join('afdellings', 'afdellings.id', '=', 'blocks.afdelling_id')
                ->join('farms', 'farms.id', '=', 'afdellings.farm_id')
                ->select('blocks.*', 'afdellings.name as afdelling', 'afdellings.id as afdelling_id', 'farms.name as farm', 'farms.id as farm_id')
                ->get();
        $job_types = JobType::all();
        $foremans = Foreman::all();

        return view('assistant.area.block.block_reference', [
            'block_references' => $block_references,
            'blocks' => $blocks,
            'job_types' => $job_types,
            'foremans' => $foremans,            
        ]);
    }

    public function block_reference_store(Request $request) {
        BlockReference::create([
            'block_id' => $request->block_id,
            'foreman_id' => $request->foreman_id,
            'jobtype_id' => $request->jobtype_id,
            'planting_year' => $request->planting_year,
            'total_coverage' => $request->total_coverage,
            'available_coverage' => $request->available_coverage,
            'population_coverage' => $request->population_coverage,
            'population_perblock' => $request->population_perblock,
        ]);
        return back()->withSuccess('block created');
    }

    public function block_reference_update (Request $request, BlockReference $block_reference) {
        $block_reference->update([
            'block_id' => $request->block_id,
            'foreman_id' => $request->foreman_id,
            'jobtype_id' => $request->jobtype_id,
            'planting_year' => $request->planting_year,
            'total_coverage' => $request->total_coverage,
            'available_coverage' => $request->available_coverage,
            'population_coverage' => $request->population_coverage,
            'population_perblock' => $request->population_perblock,
        ]);
        return back();
    }

    public function block_reference_delete (BlockReference $block_reference) {
        $block_reference->delete();
        return back();
    }

    public function getAfdelling(Request $request) {
        $afdellings = Area::where('farm_id', $request->farm_id)
                        ->select('afdelling_id')
                        ->distinct() // return without duplicaete
                        ->get() // select more than one
                        ->toArray(); // collection convert to array
        $afdelling = [];
        foreach ($afdellings as $value) {
            $afdelling[] = $value['afdelling_id'];
        }
        $afdellings = Afdelling::whereIn('id', $afdelling)->get();
        return response()->json($afdellings);
    }

    public function getBlock(Request $request) {
        $blocks = Area::where('afdelling_id', $request->afdelling_id)
                        ->select('block_id')
                        ->distinct()->get()->toArray();
        $block = [];
        foreach ($blocks as $value) {
            $block[] = $value['block_id'];
        }
        $block = Block::whereIn('id', $block)->get();
        return response()->json($block);
    }

}
