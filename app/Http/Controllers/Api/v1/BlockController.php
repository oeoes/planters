<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\BlockReference;
use Illuminate\Http\Request;
use Validator;

class BlockController extends Controller
{
    public function store_block_references(Request $request) {
        $validator = Validator::make($request->all(), [
            'block_id' => 'required',
            'foreman_id' => 'required',
            'jobtype_id' => 'required',
            'planting_year' => 'required',
            'population_coverage' => 'required',
            // 'population_perblock' => 'required', = pop.coverage / total.coverage
            'total_coverage' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors());

        // $valid_block = Block::where('afdelling_id', foreman($request->foreman_id)->afdelling_id)->where('id', $request->block_id)->first();
        // if (! $valid_block) 
        //     return res(false, 404, 'Block not allowed');

        // $block_references = BlockReference::where('block_id', $request->block_id)->where('planting_year', $request->planting_year)->first();
        // if ($block_references) 
        //     return res(false, 400, 'Reference of block already created');
            $population_perblock = ($request->population_coverage /  $request->total_coverage);

        BlockReference::create([
            'block_id' => $request->block_id,
            'foreman_id' => foreman($request->foreman_id)->id,
            'jobtype_id' => $request->jobtype_id,
            'planting_year' => $request->planting_year,
            'population_coverage' => $request->population_coverage,
            'population_perblock' => $population_perblock,
            'total_coverage' => $request->total_coverage,
            'used_coverage' => 0,
            'completed' => 0,
        ]);

        $data = [
            'block_id' => $request->block_id,
            'block_code' => block($request->block_id),
            'foreman' => foreman($request->foreman_id)->name,
            'job_type' => jobtype($request->jobtype_id),
            'planting_year' => $request->planting_year,
            'population_coverage' => $request->population_coverage,
            'population_perblock' => $request->population_perblock,
            'total_coverage' => $request->total_coverage,
            'used_coverage' => 0,
            'completed' => 0,
        ];

        return res(true, 200, 'Reference of block created', $data);
    }

    public function blocks() {
        $blocks = Block::all();
        return res(true, 200, 'Blocks listed', $blocks);
    }

    public function active_block_reference() {

    }
}
