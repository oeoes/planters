<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

use App\Models\Farm;
use App\Models\Afdelling;
use App\Models\Block;
use App\Models\Area;
use App\Models\Employee;
use App\Models\Foreman1;
use App\Models\Foreman2;

use App\Models\Maintain\RkhMaintain;
use App\Models\Maintain\ManualMaintain;
use App\Models\Maintain\HarvestSpraying;

class RkhmaintainController extends Controller
{
    /*
    ------------------------------------
        THIS CODE BELOW IS FOR FOREMAN 1
    ------------------------------------
    */

    public function foreman1_active_rkh($foreman1_id) {
        $rkhs = RkhMaintain::where('foreman1_id', $foreman1_id)->where('active', 1)->get();
        if ($rkhs->isEmpty()) {
            return res(false, 404, 'There is no active daily work plan');
        }
        $data = [];
        foreach ($rkhs as $value) {
            $data [] = [
                'id'   => $value['id'],
                'farm' => str_farm($value['farm_id']),
                'afdelling' => str_afdelling($value['afdelling_id']),
                'block'     => str_block($value['block_id']),
                'foreman1' => str_foreman1($value['foreman1_id']),
                'foreman2' => str_foreman2($value['foreman2_id']),
                'coverage' => $value['coverage'],
                'population' => $value['population'],
                'period'   => $value['period'],
                'planting_year' => $value['planting_year'],
                'employees_number' => $value['employees_number'],
                'harvest' => [
                    'type' => $value['fertilizer_type'],
                    'amount' => $value['fertilizer_amount'],
                    'period' => $value['fertilizer_period']
                ],
                'spraying' => [
                    'type' => $value['spraying_type'],
                    'amount' => $value['spraying_amount']
                ],
                'manual' => [
                    'circle' => $value['manual_circle'],
                    'pruning' => $value['manual_pruning'],
                    'gawangan' => $value['manual_gawangan']
                ],
            ];
        }
        return res(true, 200, 'Active daily work plan listed', $data);
    }
    
    public function foreman1_inactive_rkh($foreman1_id) {
        $rkhs = RkhMaintain::where('foreman1_id', $foreman1_id)->where('active', 0)->get();
        if ($rkhs->isEmpty()) {
            return res(false, 404, 'There is no inactive daily work plan');
        }
        $data = [];
        foreach ($rkhs as $value) {
            $data [] = [
                'id'   => $value['id'],
                'farm' => str_farm($value['farm_id']),
                'afdelling' => str_afdelling($value['afdelling_id']),
                'block' => str_block($value['block_id']),
                'foreman1' => str_foreman1($value['foreman1_id']),
                'foreman2' => str_foreman2($value['foreman2_id']),
                'coverage' => $value['coverage'],
                'population' => $value['population'],
                'period'   => $value['period'],
                'planting_year' => $value['planting_year'],
                'employees_number' => $value['employees_number'],
                'harvest' => [
                    'type' => $value['fertilizer_type'],
                    'amount' => $value['fertilizer_amount'],
                    'period' => $value['fertilizer_period']
                ],
                'spraying' => [
                    'type' => $value['spraying_type'],
                    'amount' => $value['spraying_amount']
                ],
                'manual' => [
                    'circle' => $value['manual_circle'],
                    'pruning' => $value['manual_pruning'],
                    'gawangan' => $value['manual_gawangan']
                ],
            ];
        }
        return res(true, 200, 'Inactive daily work plan listed', $data);
    }

    public function store(Request $request) {
        // return $request->all();
        $request->validate([
            'farm_id'          => 'required|numeric',
            'afdelling_id'     => 'required|numeric',
            'block_id'         => 'required|numeric',
            'foreman1_id'      => 'required|numeric',
            'foreman2_id'      => 'required|numeric',
            'coverage'         => 'required|numeric',
            'population'       => 'required|numeric',
            'planting_year'    => 'required|numeric',
            'employees_number' => 'required|numeric',

            // Fertilizer mode
            'fertilizer_type'   => 'required',
            'fertilizer_amount' => 'required|numeric',
            'fertilizer_period' => 'required|numeric',

            // Spraying mode
            'spraying_type'   => 'required',
            'spraying_amount' => 'required|numeric',

            // Manual mode
            'manual_circle'   => 'required|numeric',
            'manual_pruning'  => 'required|numeric',
            'manual_gawangan' => 'required|numeric',
        ]);

        $foreman2_exist = Foreman2::find($request->foreman2_id);
        if ($foreman2_exist->isactive == 1) 
            return res(false, 404, 'This foreman2 is on working', $foreman2_exist);

        $rkh_exist = RkhMaintain::where('block_id', $request->block_id)->where('period', $request->fertilizer_period)->where('planting_year', $request->planting_year)->first();
        if ($rkh_exist)
            return res(false, 404, 'Daily work plan already created');

        $selected_area = Area::where('farm_id', $request->farm_id)->where('afdelling_id', $request->afdelling_id)->where('block_id', $request->block_id)->first();
        if (! $selected_area) 
            return res(false, 404, 'Invalid selected farm, afdelling, or block.');

        $foreman2 = Foreman2::find($request->foreman2_id);
        $foreman2->isactive = 1;
        $foreman2->save();
        
        RkhMaintain::create([
            'id'          => Uuid::uuid4(),
            'area_id'     => $selected_area->id,
            'farm_id'     => $request->farm_id,
            'afdelling_id'=> $request->afdelling_id,
            'block_id'    => $request->block_id,
            'foreman1_id' => $request->foreman1_id,
            'foreman2_id' => $request->foreman2_id,
            'coverage'    => $request->coverage,
            'population'  => $request->population,
            'period'      => $request->fertilizer_period,
            'planting_year'    => $request->planting_year,
            'employees_number' => $request->employees_number,
            'active' => 1,

            // Fertilizer mode
            'fertilizer_type' => $request->fertilizer_type,
            'fertilizer_amount' => $request->fertilizer_amount,
            'fertilizer_period' => $request->fertilizer_period,

            // Spraying mode
            'spraying_type'   => $request->spraying_type,
            'spraying_amount' => $request->spraying_amount,

            // Manual mode
            'manual_circle' => $request->manual_circle,
            'manual_pruning' => $request->manual_pruning,
            'manual_gawangan' => $request->manual_gawangan
        ]);
        
        return res(true, 200, 'Daily work plan successfully created'); 

    }

    public function close(Request $request) {
        $close_rkh_maintain = RkhMaintain::where('foreman1_id', $request->foreman1_id)
                            ->where('id', $request->rkh_maintain_id)
                            ->where('active', 1)
                            ->first();
                            
        if (! $close_rkh_maintain)
            return res(false, 404, 'Daily work plan not found');

        // Set inactive Foreman2
        $foreman2 = Foreman2::find($close_rkh_maintain->foreman2_id);
        $foreman2->isactive = 0;
        $foreman2->save();

        // Set inactive RKH Maintain
        $close_rkh_maintain->decrement('active');
            return res(true, 200, 'Daily work plan successfully closed');

    }

    public function foreman2_available() {
        $foremans2 = Foreman2::where('isactive', 0)->get();
            if ($foremans2->isEmpty()) {
                return res(false, 404, 'Foreman2 empty');
            }
                return res(true, 200, 'Foreman2 listed', $foremans2);
    }

    /*
    ------------------------------------
        THIS CODE BELOW IS FOR FOREMAN 2
    ------------------------------------
    */

    public function foreman2_active_rkh($foreman2_id) {
        $rkh = RkhMaintain::where('foreman2_id', $foreman2_id)->where('active', 1)->first();
        if (! $rkh) {
            return res(false, 404, 'There is no active work plan');
        } else {
            $data = [
                'id' => $rkh->id,
                'farm' => str_farm($rkh->farm_id),
                'afdelling' => str_afdelling($rkh->afdelling_id),
                'block' => str_block($rkh->block_id)
            ];
            return res(true, 200, 'Active work plan found', $data);
        }
    }

    public function foreman2_active_rkh_list($foreman2_id, $rkh_maintain_id) {
        // return response()->json([$foreman2_id, $rkh_maintain_id], 200);   
        $valid_rkh = RkhMaintain::where('id', $rkh_maintain_id)->where('foreman2_id', $foreman2_id)->first();
        if (! $valid_rkh) 
            return res(false, 404, 'work plan invalid');

        $hs_s = HarvestSpraying::where('rkh_maintain_id', $rkh_maintain_id)->get()->toArray();
        $hs = [];
        foreach ($hs_s as $value) {
            $hs [] =[
                'id' => $value['rkh_maintain_id'],
                'employee_name' => str_employee($value['employee_id']),
                'date' => $value['date'],
                'harvest_amount' => $value['harvest_amount'],
                'harvest_coverage' => $value['harvest_coverage'],
                'harvest_image' => $value['harvest_image'],
                'spraying_amount' => $value['spraying_amount'],
                'spraying_coverage' => $value['spraying_coverage'],
                'spraying_image' => $value['spraying_image'],
                'time_start' => $value['time_start'],
                'time_end' => $value['time_end'],
                'lat' => $value['lat'],
                'lng' => $value['lng'],
                'created_at' => date("Y-m-d H:i:s", strtotime($value['created_at'])),
                'updated_at' => date("Y-m-d H:i:s", strtotime($value['updated_at'])),
            ];
        }

        $mm_s = ManualMaintain::where('rkh_maintain_id', $rkh_maintain_id)->get()->toArray();
        $mm = [] ;
        foreach ($mm_s as $value) {
            $mm [] =[
                'id' => $value['rkh_maintain_id'],
                'employee_name' => str_employee($value['employee_id']),
                'date' => $value['date'],
                'circle' => $value['circle'],
                'circle_coverage' => $value['circle_coverage'],
                'pruning' => $value['pruning'],
                'pruning_coverage' => $value['pruning_coverage'],
                'gawangan' => $value['gawangan'],
                'time_start' => $value['time_start'],
                'time_end' => $value['time_end'],
                'lat' => $value['lat'],
                'lng' => $value['lng'],
                'created_at' => date("Y-m-d H:i:s", strtotime($value['created_at'])),
                'updated_at' => date("Y-m-d H:i:s", strtotime($value['updated_at'])),
            ];
        }

        $results = collect(array_merge($hs, $mm))->sortByDesc('created_at');
        $results = $results->values();

        if (!$mm_s && !$hs_s) {
            return res(false, 400, 'Work plan not defined');
        }
            return res(true, 200, 'Work plan listed', $results);
        
    }

    public function store_harvest_spraying(Request $request) {
        // return $request->All();
        $request->validate([
            'rkh_maintain_id' => 'required',
            'employee_id' => 'required',
            'date' => 'required',
            'harvest_amount'    => 'required|numeric',
            'harvest_coverage'  => 'required|numeric',
            'spraying_amount'   => 'required|numeric',
            'spraying_coverage' => 'required|numeric',
            'time_start' => 'required',
            'time_end' => 'required',
        ]);

        $check_rkh_maintain_closed = RkhMaintain::where('id', $request->rkh_maintain_id)->where('active', 0)->first();
            if($check_rkh_maintain_closed) 
                return res(false, 404, 'Work plan already closed');

        $check_harvest_spraying_existed = HarvestSpraying::where('rkh_maintain_id', $request->rkh_maintain_id)->where('employee_id', $request->employee_id)->first();
        $check_manual_maintain_existed  = ManualMaintain::where('rkh_maintain_id', $request->rkh_maintain_id)->where('employee_id', $request->employee_id)->first();
            if($check_harvest_spraying_existed || $check_manual_maintain_existed) 
                return res(false, 404, 'Work plan already registered');

        // Check file image for harvest_image
        if ($request->hasFile('harvest_image')) {
            $request->validate([ 'harvest_image' => 'image:jpeg,png,jpg|max:2048'  ]);
            $harvest_image = $request->file('harvest_image');
            $harvest_image_folder = 'maintain/harvest';
            $harvest_image_name = Uuid::uuid4() . '.' . $harvest_image->getClientOriginalExtension();
            $harvest_image_mime_type = $harvest_image->getClientMimeType();
            $harvest_image_url = Storage::disk('public')->put($harvest_image_folder, $harvest_image);
        } else {
            $harvest_image_url = null;
        }

        // Check file image for harvest_image
        if ($request->hasFile('spraying_image')) {
            $request->validate([ 'spraying_image' => 'image:jpeg,png,jpg|max:2048'  ]);
            $spraying_image = $request->file('spraying_image');
            $spraying_image_folder = 'maintain/spraying';
            $spraying_image_name = Uuid::uuid4() . '.' . $spraying_image->getClientOriginalExtension();
            $spraying_image_url = Storage::disk('public')->put($spraying_image_folder, $spraying_image);
        } else {
            $spraying_image_url = null;
        }

        HarvestSpraying::create([
            'rkh_maintain_id' => $request->rkh_maintain_id,
            'employee_id' => $request->employee_id,
            'date' => $request->date,

            'harvest_amount' => $request->harvest_amount,
            'harvest_coverage' => $request->harvest_coverage,
            'harvest_image' => asset('/storage/'.$harvest_image_url),

            'spraying_amount' => $request->spraying_amount,
            'spraying_coverage' => $request->spraying_coverage,
            'spraying_image' => asset('/storage/'.$spraying_image_url),

            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);

        // $data = [

        return res(true, 200, 'Work plan added successfully');

    }

    public function store_manual_maintain(Request $request) {
        $request->validate([
            'rkh_maintain_id'  => 'required',
            'employee_id'      => 'required|numeric',
            'circle'           => 'required|numeric|min:1',
            'circle_coverage'  => 'required|numeric|min:1',
            'pruning'          => 'required|numeric|min:1',
            'pruning_coverage' => 'required|numeric|min:1',
            'gawangan'         => 'required|numeric|min:1',
            'date'             => 'required',
            'time_start' => 'required',
            'time_end'   => 'required',
        ]);

        $check_rkh_maintain_closed = RkhMaintain::where('id', $request->rkh_maintain_id)->where('active', 0)->first();
            if($check_rkh_maintain_closed) return res(false, 404, 'Work plan already closed');

        $check_maintain_manual_existed = ManualMaintain::where('rkh_maintain_id', $request->rkh_maintain_id)->where('employee_id', $request->employee_id)->first();
            if($check_maintain_manual_existed) return res(false, 404, 'Work plan already registered');

        try {
            ManualMaintain::create([
                'rkh_maintain_id'   => $request->rkh_maintain_id,
                'employee_id' => $request->employee_id,
                'circle'            => $request->circle,
                'circle_coverage'   => $request->circle_coverage,
                'pruning'           => $request->pruning,
                'pruning_coverage'  => $request->pruning_coverage,
                'gawangan'          => $request->gawangan,
                'date' => $request->date,
                'time_start' => $request->time_start,
                'time_end' => $request->time_end,
                'lat' => $request->lat,
                'lng' => $request->lng
            ]);
         } catch ( \Exception $e) {
            return res(false, 404, 'Work plan invalid');
         }
            return res(true, 200, 'Work plan added successfully');

    }

    public function employees () {
        $employees = Employee::all();
        return res(true, 200, 'Employees listed', $employees);
    }

}
