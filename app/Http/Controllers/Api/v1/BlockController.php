<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Afdelling;
use App\Models\AfdellingReference;
use App\Models\Block;
use App\Models\BlockReference;
use App\Models\Harvesting\EmployeeHarvesting;
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
use Illuminate\Support\Facades\Auth;
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
            'total_coverage' => 'required',
        ]);

        if ($request->foreman_id != fme()->id)
            return res(false, 404, 'Foreman not authenticated');

        if ($validator->fails())
            return res(false, 404, $validator->errors());

        $valid_block = Block::where('afdelling_id', foreman($request->foreman_id)->afdelling_id)->where('id', $request->block_id)->first();
        if (! $valid_block) 
            return res(false, 404, 'Block not allowed');

        $block_references = BlockReference::where('block_id', $request->block_id)->where('planting_year', $request->planting_year)->first();
        if ($block_references ) {
            if (in_array($request->jobtype_id, [1, 2, 3, 4, 5, 6])) {
                return res(false, 400, 'Reference of block already created', [ 'block_reference_id' => $block_references->id]);
            }
        }
            
        $population_perblock = $request->total_coverage * $request->population_coverage;

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

        return res(true, 200, 'Reference of block created');
    }

    public function blocks($afdelling_id) {
        $blocks = Block::where('afdelling_id', $afdelling_id)->get();
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
    public function completed_block_references() {
        $refs = BlockReference::where('foreman_id', fme()->id)
                                ->where('completed', 1)
                                ->orderByDesc('created_at')
                                ->get();
        $data = [];
        if ($refs->isEmpty()) {
            return res(true, 200, 'Empty blocks');
        } else {
            foreach ($refs as $value) {
                $data [] = [
                    'block_reference_id' => $value['id'],
                    'planting_year' => $value['planting_year'],
                    'block_name' => block($value['block_id']),
                ];
            }
            return res(true, 200, 'Blocks listed', $data);
        }
    }

    // active block references
    public function active_block_references() {
        $refs = BlockReference::where('foreman_id', fme()->id)->where('completed', 0)->get();
        if ($refs->isEmpty()) {
            return res(true, 200, 'Empty block references');
        }
            
        $active = [];
        foreach ($refs as $value) {
            if ($value['completed'] == 0) {
                $active [] = [
                    'block_reference_id' => $value['id'],
                    'planting_year' => $value['planting_year'],
                    'block_code' => block($value['block_id']),
                ];
            }
        }
        return res(true, 200, 'Blocks listed', $active);
    }

    public function det_active_block_references($block_ref_id) {
        $single_ref = BlockReference::find($block_ref_id);
        $today = date('Y-m-d');
        //search today where rkh didnot completed
        $data = $single_ref->model::where('date', $today)->where('block_ref_id', $block_ref_id)->where('completed', 0)->first();
        if ($data) {
            if (in_array($single_ref->jobtype_id, [1, 2, 6])) {
                $ingredients_amount = $data->ingredients_amount;
                $ingredients_type = $data->ingredients_type;
                $akp = null;
                $bjr = null;
            } else if (in_array($single_ref->jobtype_id, [3, 4, 5])) {
                $ingredients_amount = null;
                $ingredients_type = null;
                $akp = null;
                $bjr = null;
            } else if (in_array($single_ref->jobtype_id, [7])) {
                $ingredients_amount = null;
                $ingredients_type = null;
                $akp = $data->akp;
                $bjr = $data->bjr;
            }

            $foreman = [
                'date' => date('Y-m-d', strtotime($data->date)),
                'subforeman' => subforeman($data->subforeman_id)->name,
                'block_code' => block($single_ref->block_id),
                'job_type'   => $single_ref->jobtype_id,
                'target_coverage'    => $data->target_coverage,
                'akp' => $akp,
                'bjr' => $bjr,
                'taksasi' => $data->taksasi,
                'basis' => $data->basis,
                'ingredients_type'   => $ingredients_type,
                'ingredients_amount' => $ingredients_amount,
                'foreman_note' => $data->foreman_note,
                'hk_used'   => $data->hk_used,
                'completed' => 0,
            ];

            switch ($single_ref->jobtype_id) {
                case 1:
                    $fillout = $single_ref->fill::where('spraying_id', $data->id)->first();
                    break;
                case 2:
                    $fillout = $single_ref->fill::where('fertilizer_id', $data->id)->first();
                    break;
                case 3:
                    $fillout = $single_ref->fill::where('circle_id', $data->id)->first();
                    break;
                case 4:
                    $fillout = $single_ref->fill::where('pruning_id', $data->id)->first();
                    break;
                case 5:
                    $fillout = $single_ref->fill::where('gawangan_id', $data->id)->first();
                    break;
                case 6:
                    $fillout = $single_ref->fill::where('pcontrol_id', $data->id)->first();
                    break;
                case 7:
                    $fillout = $single_ref->fill::where('harvest_id', $data->id)->first();
                    break;
            }

            if ($fillout) {

                if (in_array($single_ref->jobtype_id, [1, 2, 6])) {
                    $ingredients_amount = $fillout->fingredients_amount;
                    $ingredients_type   = $fillout->ingredients_type;
                    $akp = null;
                    $bjr = null;
                    $hk_names = $fillout->hk_name;
                    $final_harvesting = null;
                } else if (in_array($single_ref->jobtype_id, [3, 4, 5])) {
                    $ingredients_amount = null;
                    $ingredients_type = null;
                    $akp = null;
                    $bjr = null;
                    $hk_names = $fillout->hk_name;
                    $final_harvesting = null;
                } else if (in_array($single_ref->jobtype_id, [7])) {
                    $ingredients_amount = null;
                    $ingredients_type = null;
                    $akp = $fillout->akp;
                    $bjr = $fillout->bjr;
                    $harvest_id = $data->id;
                    $employee_harvestings = EmployeeHarvesting::where('harvest_id', $harvest_id)->get();
                    $hk_listed = $employee_harvestings;
                    $hk_listed_arr = [];
                    $final_harvesting = 0;
                    foreach ($hk_listed as $hk) {
                        $hk_listed_arr [] = [
                            'name' => $hk['name'],
                            'total_harvesting' => $hk['total_harvesting']
                        ];
                        $final_harvesting += $hk['total_harvesting'];
                    }
                }

                $subforeman = [
                    "begin" => $fillout->begin,
                    "ended" => $fillout->ended,
                    "target_coverage"    => $fillout->ftarget_coverage,
                    "ingredients_type"   => $ingredients_type,
                    "ingredients_amount" => $ingredients_amount,
                    "image" => $fillout->image,
                    "subforeman_note" => $fillout->subforeman_note,
                    "completed" => $fillout->completed,
                    "hk_name" => isset($hk_names) ? $hk_names : null,
                    "hk_listed" => isset($hk_listed_arr) ? $hk_listed_arr : null,
                    "final_harvesting" => $final_harvesting,
                ];

            } else {
                $subforeman = null;
            }

            $data = [
                "foreman" => $foreman,
                "subforeman" => $subforeman
            ];

            return res(true, 200, 'Detail RKH', $data); 
        } else {
            if ($single_ref->jobtype_id == 7) {
                $data = [
                    'block_code' => block($single_ref->block_id),
                    'job_type' => $single_ref->jobtype_id,
                    'available_coverage' => $single_ref->available_coverage,
                    'population_coverage' => $single_ref->population_coverage,
                ];
            } else {
                $data = [
                    'block_code' => block($single_ref->block_id),
                    'job_type' => $single_ref->jobtype_id,
                    'available_coverage' => $single_ref->available_coverage
                ];
            }

            return res(true, 200, 'There is no schedule today, create another RKH for tomorrow', $data);
        }

    }   

}