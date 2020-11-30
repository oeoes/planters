<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Afdelling;
use App\Models\AfdellingReference;
use App\Models\Block;
use App\Models\BlockReference;
use App\Models\Harvesting\FillHarvesting;
use App\Models\Maintain\CircleType;
use App\Models\Maintain\FertilizerType;
use App\Models\Maintain\FillCircle;
use App\Models\Maintain\FillFertilizer;
use App\Models\Maintain\FillGawangan;
use App\Models\Maintain\FillPruning;
use App\Models\Maintain\FillSpraying;
use App\Models\Maintain\GawanganType;
use App\Models\Maintain\PestControl;
use App\Models\Maintain\PruningType;
use App\Models\Maintain\SprayingType;
use Illuminate\Http\Request;
// use App\Models\Harvesting\HarvestingType;
// use App\Models\Harvesting\FillHarvesting;
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

        $valid_block = Block::where('afdelling_id', foreman($request->foreman_id)->afdelling_id)->where('id', $request->block_id)->first();
        if (! $valid_block) 
            return res(false, 404, 'Block not allowed');

        $block_references = BlockReference::where('block_id', $request->block_id)->where('planting_year', $request->planting_year)->first();
        if ($block_references) 
            return res(false, 400, 'Reference of block already created', [ 'block_reference_id' => $block_references->id]);
            $population_perblock = ($request->population_coverage /  $request->total_coverage);
        
        $afdelling_ref = AfdellingReference::where('afdelling_id', fme()->afdelling_id)->first();
        if ($afdelling_ref != null) {
            if ($afdelling_ref->available_hk == 0) {
                return res(false, 404, 'Cannot create block reference for today, there is no employees available');
            }   
        }


        BlockReference::create([
            'block_id'   => $request->block_id,
            'foreman_id' => fme()->id,
            'jobtype_id' => $request->jobtype_id,
            'planting_year' => $request->planting_year,
            'population_coverage' => $request->population_coverage,
            'population_perblock' => $population_perblock,
            'total_coverage'      => $request->total_coverage,
            'available_coverage'  => $request->total_coverage,
            'model' => model($request->jobtype_id),
            'fill'  => fill($request->jobtype_id),
            'completed' => 0,
        ]);
        $last_block_reference = BlockReference::where('foreman_id', fme()->id)->latest()->first();
        $data = [
            'block_reference_id'   => (int) $last_block_reference->id,
            'block_code' => (int) block($request->block_id),
            'foreman'    => foreman($request->foreman_id)->name,
            'job_type'   => (int) $request->jobtype_id,
            'planting_year' => (int) $request->planting_year,
            'population_coverage' => (float) $request->population_coverage,
            'population_perblock' => (float) $population_perblock,
            'total_coverage'      => (float) $request->total_coverage,
            'available_coverage'  => (float) $request->total_coverage,
            'completed' => 0,
        ];

        return res(true, 200, 'Reference of block created', $data);
    }

    public function blocks() {
        $blocks = Block::all();
        $data = [];
        foreach ($blocks as $key => $value) {
            $data [] = [
                'id' => $value['id'],
                'name' => $value['code'],
                'afdelling_id' => $value['afdelling_id']
            ];
        }
        return res(true, 200, 'Blocks listed', $data);
    }

    // all blocks
    public function block_references() {
        $refs = BlockReference::where('foreman_id', auth()->guard('foreman')->user()->id)->where('completed', 1)->orderByDesc('created_at')->get();
        $data = [];
        if (! $refs->isEmpty()) {
            foreach ($refs as $value) {
                $data [] = [
                    'block_reference_id' => $value['id'],
                    'planting_year' => $value['planting_year'],
                    'block_name' => block($value['block_id']),
                ];
            }
            return res(true, 200, 'Blocks listed', $data);
        } else {
            return res(true, 200, 'Empty blocks');
        }
    }

    // active block references
    public function active_block_references() {
        $refs = BlockReference::where('foreman_id', auth()->guard('foreman')->user()->id)
                            //   ->where('completed', 0)
                              ->orderByDesc('created_at')
                              ->get();
        $data = [];

        if (! $refs->isEmpty()) {
            foreach ($refs as $value) {
                $data [] = [
                    'block_reference_id' => $value['id'],
                    'planting_year' => $value['planting_year'],
                    'block_code' => block($value['block_id']),
                ];
            }
            return res(true, 200, 'Blocks listed', $data);
        } else {
            return res(true, 200, 'There is no active block');
        }
    }

    public function det_active_block_references($block_ref_id) {
        $single_ref = BlockReference::find($block_ref_id);
        $afdelling_id = auth()->guard('foreman')->user()->afdelling_id;
        $now = date('Y-m-d');
        $data = $single_ref->model::where('block_ref_id', $block_ref_id)->where('completed', 0)->first();

        if(! $data) {
            $afdelling_ref = AfdellingReference::whereDate('available_date', date('Y-m-d'))->where('afdelling_id', $afdelling_id)->first();
            $afdelling = Afdelling::where('id', fme()->afdelling_id)->first();
            if (! $afdelling_ref) {
                AfdellingReference::create([
                    'afdelling_id' => fme()->afdelling_id,
                    'available_hk' => $afdelling->hk_total,
                    'available_date' => $now 
                ]);   
                $afdelling_ref = AfdellingReference::where('available_date', $now)->first();
                $available_hk = $afdelling_ref->available_hk;
            } else {
                $available_hk = $afdelling_ref->available_hk;
            }

            $data = [
                'block_code' => block($single_ref->block_id),
                'job_type' => $single_ref->jobtype_id,
                'available_hk' => $available_hk,
                'available_coverage' => $single_ref->available_coverage
            ];
            return res(true, 200, 'Cannot find RKH for today', $data);
            
        } else {

            if (in_array($single_ref->jobtype_id, [1, 2, 6])) {
                $ingredients_amount = $data->ingredients_amount;
                $ingredients_type = $data->ingredients_type;
                $target_akp = null;
                $target_bjr = null;
            } else if (in_array($single_ref->jobtype_id, [3, 4, 5])) {
                $ingredients_amount = null;
                $ingredients_type = null;
                $target_akp = null;
                $target_bjr = null;
            } else if (in_array($single_ref->jobtype_id, [7])) {
                $ingredients_amount = null;
                $ingredients_type = null;
                $target_akp = $data->target_akp;
                $target_bjr = $data->target_bjr;
            }

            $foreman = [
                'date' => date('Y-m-d', strtotime($data->date)),
                'subforeman' => subforeman($data->subforeman_id)->name,
                'block_code' => block($single_ref->block_id),
                'job_type'   => $single_ref->jobtype_id,
                'target_coverage'    => $data->target_coverage,
                'target_akp' => $target_akp,
                'target_bjr' => $target_bjr,
                'ingredients_type'   => $ingredients_type,
                'ingredients_amount' => $ingredients_amount,
                'foreman_note' => $data->foreman_note,
                'hk_used'   => $data->hk_used,
                'completed' => 0,
            ];

            $fillout = $single_ref->fill::where('harvest_id', $data->id)->first();

            if (! $fillout) {
                $subforeman = null;
            } else {
                $subforeman = [
                    "begin" => $fillout->begin,
                    "ended" => $fillout->ended,
                    "target_coverage" => $fillout->ftarget_coverage,
                    "ingredients_amount" => $fillout->fingredients_amount,
                    "image" => $fillout->image,
                    "subforeman_note" => $fillout->subforeman_note,
                    "hk_name" => $fillout->hk_name,
                ];
            }

            $data = [
                "foreman" => $foreman,
                "subforeman" => $subforeman
            ];
            
            return res(true, 200, 'Detail RKH', $data); 
        }   

    }
}
