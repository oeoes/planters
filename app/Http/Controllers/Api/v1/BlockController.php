<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Afdelling;
use App\Models\AfdellingReference;
use App\Models\Block;
use App\Models\BlockReference;
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
            return res(false, 400, 'Reference of block already created');
            $population_perblock = ($request->population_coverage /  $request->total_coverage);

        BlockReference::create([
            'block_id'   => $request->block_id,
            'foreman_id' => fme()->id,
            'jobtype_id' => $request->jobtype_id,
            'planting_year' => $request->planting_year,
            'population_coverage' => $request->population_coverage,
            'population_perblock' => $population_perblock,
            'total_coverage'      => $request->total_coverage,
            'available_coverage'  => $request->total_coverage,
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
        $refs = BlockReference::where('foreman_id', auth()->guard('foreman')->user()->id)->where('completed', 0)->orderByDesc('created_at')->get();
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
        $afdelling_ref = AfdellingReference::where('afdelling_id', $afdelling_id)->where('available_date', $now)->first();
        // Jika datanya blm tersedia diinput mandor
        switch($single_ref->jobtype_id) {
            case 1:
                // jika job type yg dituju blm diisi mandor 1,
                // diarahin ke create rkh
                $check = SprayingType::where('block_ref_id', $block_ref_id)->where('date', $now)
                        ->where('completed', 0)->first(); 
                $filling = FillSpraying::find($check->id);
            break;

            case 2:
                $check = FertilizerType::where('block_ref_id', $block_ref_id)->where('date', $now)
                        ->where('completed', 0)->first(); 
                $filling = FillFertilizer::find($check->id);
            break;

            case 3:
                $check = CircleType::where('block_ref_id', $block_ref_id)->where('date', $now)
                        ->where('completed', 0)->first(); 
                $filling = FillCircle::find($check->id);
            break;

            case 4:
                $check = PruningType::where('block_ref_id', $block_ref_id)->where('date', $now)
                        ->where('completed', 0)->first(); 
                $filling = FillPruning::find($check->id);
            break;

            case 5:
                $check = GawanganType::where('block_ref_id', $block_ref_id)->where('date', $now)
                        ->where('completed', 0)->first(); 
                $filling = FillGawangan::find($check->id);
            break;

            case 6:
                $check = PestControl::where('block_ref_id', $block_ref_id)->where('date', $now)
                        ->where('completed', 0)->first(); 
                $filling = PestControl::find($check->id);
            break;
        }
        if (! $check) {
            // Sebelum create rkh dibuat, baiknya create blok ref
            // sebelum buat blok ref, baiknya definisikan afdelling refs
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
                $ingredients_amount = $check->ingredients_amount;
                $ingredients_type = $check->ingredients_type;
            } else {
                // kalau opsinya ke manual, dia gada jenis dan bahan
                $ingredients_amount = null;
                $ingredients_type = null;
            }

            $foreman = [
                'date' => date('Y-m-d', strtotime($check->date)),
                'subforeman' => subforeman($check->subforeman_id)->name,
                'block_code' => block($single_ref->block_id),
                'job_type' => $single_ref->jobtype_id,
                'target_coverage' => $check->target_coverage,
                'ingredients_type' => $ingredients_type,
                'ingredients_amount' => $ingredients_amount,
                'foreman_note' => $check->foreman_note,
                'hk_used' => $check->hk_used,
                'completed' => 0,
            ];

            if (! $filling) {
                $subforeman = null;
            } else {
                $subforeman = [
                    "begin" => $filling->begin,
                    "ended" => $filling->ended,
                    "target_coverage" => $filling->ftarget_coverage,
                    "ingredients_amount" => $filling->fingredients_amount,
                    "image" => $filling->image,
                    "subforeman_note" => $filling->subforeman_note,
                    "hk_name" => $filling->hk_name,
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
