<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Afdelling;
use App\Models\AfdellingReference;
use App\Models\Block;
use App\Models\BlockReference;
use App\Models\BlockStaticReference;
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

        $valid_block = Block::where('afdelling_id', foreman($request->foreman_id)->afdelling_id)->where('id', $request->block_id)->first();
        if (! $valid_block)  return res(false, 404, 'Block not allowed');

        // ngecek apakah ada blok referensi yg bloknya XX itu ad ayg blm complete
        $block_reference = BlockReference::where('block_id', $request->block_id)->where('completed', 0)->count();
        if ($block_reference > 0)  return res(false, 404, 'Failed to create, another work in this block still on progress');

        $block_static = BlockStaticReference::where('block_id', $request->block_id)->first();
        if ($block_static->count() > 0) {
            $block_reference = BlockReference::where('block_id', $request->block_id)->get();
            BlockReference::create([
                'block_static_reference_id' => $block_static->id,
                'block_id'   => $request->block_id,
                'foreman_id' => fme()->id,
                'jobtype_id' => $request->jobtype_id,
                'iterate'       => $block_reference->count() + 1,
                'planting_year' => $block_static->planting_year,
                'population_coverage' => $block_static->population_coverage,
                'population_perblock' => $block_static->population_perblock,
                'total_coverage'      => $block_static->total_coverage,
                'available_coverage'  => $block_static->total_coverage,
                'model' => model($request->jobtype_id),
                'fill'  => fill($request->jobtype_id),
                'fill_id' => fill_id($request->jobtype_id),
                'completed' => 0,
            ]);

        return res(true, 200, 'Reference of block created');
        } 
        return res(false, 404, 'Block static not found');
    }

    public function blocks($afdelling_id) {
        $blocks = Block::where('afdelling_id', $afdelling_id)->get();
        $data = [];
        foreach ($blocks as $key => $value) {
            $data [] = [
                'block_id' => $value['id'],
                'block_code' => $value['code'],
                // 'afdelling_id' => $value['afdelling_id']
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
    public function active_block_references($task_mode) {
        if ($task_mode == 1) {
            $refs = BlockReference::where('foreman_id', fme()->id)->where('completed', 0)->whereIn('jobtype_id', [1,2,3,4,5,6])->get();
        } else {
            $refs = BlockReference::where('foreman_id', fme()->id)->where('completed', 0)->where('jobtype_id', 7)->get();
        }
        
        if ($refs->isEmpty()) return res(true, 200, 'Empty block references');
            
        $active = [];
        foreach ($refs as $value) {
            if ($value['completed'] == 0) {
                $active [] = [
                    'block_reference_id' => $value['id'],
                    'job_type' => $value['jobtype_id'],
                    'block_code' => block($value['block_id']),
                ];
            }
        }
        return res(true, 200, 'Blocks listed', $active);
    }

    public function det_active_block_references($block_ref_id) {

        $single_ref = BlockReference::where('id', $block_ref_id)->where('completed', 0)->first();
        $today = date('Y-m-d');

        //search today where rkh didnot completed
        $data = $single_ref->model::where('date', $today)
                                    ->where('block_ref_id', $block_ref_id)
                                    ->where('completed', 0)
                                    ->first();

        // kalo ada data hari ini
        if ($data) {

            $foreman = [
                'date' => date('Y-m-d', strtotime($data->date)),
                'subforeman' => subforeman($data->subforeman_id)->name,
                'block_code' => block($single_ref->block_id),
                'job_type'   => $single_ref->jobtype_id,
                'target_coverage'    => $data->target_coverage,
                'akp'        => !$data->akp     ? null : $data->akp,
                'bjr'        => !$data->bjr     ? null : $data->bjr,
                'taksasi'    => !$data->taksasi ? null : $data->taksasi,
                'basis'      => !$data->basis   ? null : $data->basis,
                'ingredients_type'   => !$data->ingredients_type   ? null : $data->ingredients_type,
                'ingredients_amount' => !$data->ingredients_amount ? null : $data->ingredients_amount,
                'foreman_note' => $data->foreman_note,
                'hk_used'      => $data->hk_used,
                'completed'    => $data->completed,
            ];

            switch ($single_ref->jobtype_id) {
                case 1: $fillout = $single_ref->fill::where('spraying_id', $data->id)->first(); break;
                case 2: $fillout = $single_ref->fill::where('fertilizer_id', $data->id)->first(); break;
                case 3: $fillout = $single_ref->fill::where('circle_id', $data->id)->first(); break;
                case 4: $fillout = $single_ref->fill::where('pruning_id', $data->id)->first(); break;
                case 5: $fillout = $single_ref->fill::where('gawangan_id', $data->id)->first(); break;
                case 6: $fillout = $single_ref->fill::where('pcontrol_id', $data->id)->first(); break;
                case 7: $fillout = $single_ref->fill::where('harvest_id', $data->id)->first(); break;
            }

            if ($fillout) {

                if ($single_ref->jobtype_id == 7) {
                    $employee_harvestings = EmployeeHarvesting::where('harvest_id', $data->id)->get();
                    $hk_listed_arr = [];
                    foreach ($employee_harvestings as $hk) {
                        $hk_listed_arr [] = [
                            'name' => $hk['name'],
                            'total_harvesting' => $hk['total_harvesting']];
                    }
                }

                $subforeman = [
                    "begin" => $fillout->begin,
                    "ended" => $fillout->ended,
                    "target_coverage"    => $fillout->ftarget_coverage,
                    "ingredients_type"   => !$fillout->ingredients_type ? null : $fillout->ingredients_type,
                    "ingredients_amount" => !$fillout->fingredients_amount ? null : $fillout->fingredients_amount,
                    "image"              => $fillout->image,
                    "subforeman_note"    => $fillout->subforeman_note,
                    "completed"          => $fillout->completed,
                    "hk_name"            => !$fillout->hk_name ? null : $fillout->hk_name,
                    "hk_listed"          => isset($hk_listed_arr) ? $hk_listed_arr : null,
                    "total_harvesting" => !$fillout->total_harvesting ? null : $fillout->total_harvesting,
                    "final_harvesting" => !$fillout->final_harvesting ? null : $fillout->final_harvesting,
                    // "bjr" => !$fillout->bjr ? null : $fillout->bjr,
                    "completed" => $fillout->completed,
                ];

            } else {
                $subforeman = null;
            }

            $data = [
                "foreman" => $foreman,
                "subforeman" => $subforeman
            ];

            return res(true, 200, 'Detail RKH', $data); 

        // kalo gada data hari ini
        } else {

            // kalo ada data untuk date diatas today
            $data_next = $single_ref->model::where('date', '>', $today)->where('block_ref_id', $block_ref_id)->first();
            if ($data_next) {
                return res(true, 200, 'Your rkh is active for tomorrow', ['create' => 1]);
            } elseif (! $data_next) {
                // kalo gada data rkh untuk besok

                $data = [
                    'block_code' => block($single_ref->block_id),
                    'job_type' => $single_ref->jobtype_id,
                    'available_coverage' => $single_ref->available_coverage,
                    'population_coverage' => !$single_ref->population_coverage ? null : $single_ref->population_coverage,
                    'create' => 0,
                ];

                return res(true, 200, "Empty RKH for tomorrow, please create RKH First", $data);

            }



        }

    }   

    public function store_block_static_reference() {
        
    }

}