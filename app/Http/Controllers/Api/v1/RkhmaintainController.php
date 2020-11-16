<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Ramsey\Uuid\Uuid;

use App\Models\Farm;
use App\Models\Afdelling;
use App\Models\Block;
use App\Models\Area;
use App\Models\Employee;
use App\Models\Foreman1;
use App\Models\Foreman2;

use App\Models\Maintain\RkhMaintain;
use App\Models\Maintain\RkhHarvestMaintain;
use App\Models\Maintain\RkhSprayingMaintain;
use App\Models\Maintain\RkhManualMaintain;
use App\Models\Maintain\HarvestMaintain;
use App\Models\Maintain\SprayingMaintain;
use App\Models\Maintain\ManualMaintain;

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
                'farm' => $this->str_farm($value['farm_id']),
                'afdelling' => $this->str_afdelling($value['afdelling_id']),
                'block' => $this->str_block($value['block_id']),
                'foreman1' => $this->str_foreman1($value['foreman1_id']),
                'foreman2' => $this->str_foreman2($value['foreman2_id']),
                'coverage' => $value['coverage'],
                'population' => $value['population'],
                'period'   => $value['period'],
                'planting_year' => $value['planting_year'],
                'employees_number' => $value['employees_number']
            ];
        }
        return res(true, 200, 'Daily work plan listed', $data);
    }
    
    public function foreman1_inactive_rkh($foreman1_id) {
        $rkhs = RkhMaintain::where('foreman1_id', $foreman1_id)->where('active', 0)->get();
        if ($rkhs->isEmpty()) {
            return res(false, 400, 'There is no inactive daily work plan');
        }
        $data = [];
        foreach ($rkhs as $value) {
            $data [] = [
                'id'   => $value['id'],
                'farm' => $this->str_farm($value['farm_id']),
                'afdelling' => $this->str_afdelling($value['afdelling_id']),
                'block' => $this->str_block($value['block_id']),
                'foreman1' => $this->str_foreman1($value['foreman1_id']),
                'foreman2' => $this->str_foreman2($value['foreman2_id']),
                'coverage' => $value['coverage'],
                'population' => $value['population'],
                'period'   => $value['period'],
                'planting_year' => $value['planting_year'],
                'employees_number' => $value['employees_number']
            ];
        }
        return res(true, 200, 'Inactive daily work plan listed', $data);
    }

    public function store(Request $request) {
        // return response()->json($request->all(), 200);

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
            'date'             => 'required',
        ]);

        $foreman2_exist = Foreman2::find($request->foreman2_id);
        if ($foreman2_exist->isactive == 1) 
            return res(false, 404, 'This foreman2 is on working', $foreman2_exist);

        $rkh_exist = RkhMaintain::where('block_id', $request->block_id)
                                ->where('period', $request->fertilizer_period)
                                ->where('planting_year', $request->planting_year)
                                ->first();
        // if existed on table
        if ($rkh_exist)
            return res(false, 404, 'Daily work plan already created');

        // return response()->json($request->all());
        // 1. generate rkh mainain
        // 2. generate harvest
        // 3. generate spray
        // 4. generate manual
        // 5. set active foreman 2

        $selected_area = Area::where('farm_id', $request->farm_id)
                             ->where('afdelling_id', $request->afdelling_id)
                             ->where('block_id', $request->block_id)
                             ->first();

        if (! $selected_area) 
            return res(false, 404, 'Invalid selected farm, afdelling, or block.');

        $foreman1 = Foreman1::find($request->foreman1_id);
        $foreman2 = Foreman2::find($request->foreman2_id);
        $foreman2->isactive = 1;
        $foreman2->save();
        $rkh_maintain = RkhMaintain::create([
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
            'date'        => $request->date,
            'planting_year'    => $request->planting_year,
            'employees_number' => $request->employees_number,
            'active' => 1,
        ]);
        
        if ($rkh_maintain) {
            // Generate harvest
            $last_rkh_maintain = RkhMaintain::where('foreman1_id', $request->foreman1_id)->where('active', 1)->latest()->first();
            $rkh_harvest_maintain = RkhHarvestMaintain::create([
                'rkh_maintain_id' => $last_rkh_maintain->id,
                'fertilizer_type' => $request->fertilizer_type,
                'fertilizer_amount' => $request->fertilizer_amount,
                'fertilizer_period' => $request->fertilizer_period
            ]);
            
            if ($rkh_harvest_maintain) {
                // Generate spraying
                $rkh_spraying_maintain = RkhSprayingMaintain::create([
                    'rkh_maintain_id' => $last_rkh_maintain->id,
                    'spraying_type'   => $request->spraying_type,
                    'spraying_amount' => $request->spraying_amount
                ]);

                if ($rkh_spraying_maintain) {
                    // Generate manual 
                    $rkh_manual_maintain = RkhManualMaintain::create([
                        'rkh_maintain_id' => $last_rkh_maintain->id,
                        'circle' => $request->manual_circle,
                        'pruning' => $request->manual_pruning,
                        'gawangan' => $request->manual_gawangan
                    ]);

                    if ($rkh_manual_maintain) {
                        // Store data
                        // $data = [
                        //     'daily_work_plan' => [ 
                        //         'id'          => $last_rkh_maintain->id,
                        //         'area_id'     => $selected_area->id,
                        //         'farm'     => $this->str_farm($request->farm_id),
                        //         'afdelling'=> $this->str_afdelling($request->afdelling_id),
                        //         'block'    => $this->str_block($request->block_id),
                        //         'foreman1_id' => $request->foreman1_id,
                        //         'foreman2_id' => $request->foreman2_id,
                        //         'foreman1' => $foreman1->name,
                        //         'foreman2' => $foreman2->name,
                        //         'coverage'    => $request->coverage,
                        //         'population'  => $request->population,
                        //         'period'      => $request->fertilizer_period,
                        //         'planting_year'    => $request->planting_year,
                        //         'employees_number' => $request->employees_number,
                        //         'active'   => 1,
                        //         'harvest'  => $rkh_harvest_maintain,
                        //         'spraying' => $rkh_spraying_maintain,
                        //         'manual'   => $rkh_manual_maintain
                        //     ],
                        // ];
        
                        return res(true, 200, 'Daily work plan successfully created'); 
                    }
                }
            }
        }
    }

    public function close(Request $request) {
        $close_rkh_maintain = RkhMaintain::where('foreman1_id', $request->foreman1_id)
                            ->where('id', $request->rkh_maintain_id)
                            ->where('active', 1)
                            ->first();
                            
        if (! $close_rkh_maintain)
            return res(false, 400, 'Daily work plan not found');

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
            if ($foremans2->isEmpty()) 
                return res(false, 404, 'Foreman2 empty');
                return res(true, 200, 'Foreman2 listed');
    }

    /*
    ------------------------------------
        THIS CODE BELOW IS FOR FOREMAN 2
    ------------------------------------
    */

    public function foreman2_active_rkh($foreman2_id) {
        $rkh = RkhMaintain::where('foreman2_id', $foreman2_id)->where('active', 1)->first();
        if (! $rkh) {
            return res(false, 400, 'There is no active work plan');
        } else {
            $data = [
                'rkh_maintain_id' => $rkh->id,
                'farm' => $this->str_farm($rkh->farm_id),
                'afdelling' => $this->str_afdelling($rkh->afdelling_id),
                'block' => $this->str_block($rkh->block_id)
            ];
            return res(true, 200, 'Active work plan found', $data);
        }
    }

    public function foreman2_inactive_rkh($foreman2_id) {
        $rkhs = RkhMaintain::where('foreman2_id', $foreman2_id)->where('active', 0)->get();
        if ($rkhs->isEmpty()) {
            return res(false, 400, 'There is no inactive work plan');
        }
        $data = [];
        foreach ($rkhs as $value) {
            $data [] = [
                'id'   => $value['id'],
                'farm' => $this->str_farm($value['farm_id']),
                'afdelling' => $this->str_afdelling($value['afdelling_id']),
                'block' => $this->str_block($value['block_id']),
                'foreman1' => $this->str_foreman1($value['foreman1_id']),
                'foreman2' => $this->str_foreman2($value['foreman2_id']),
                'coverage' => $value['coverage'],
                'population' => $value['population'],
                'period'   => $value['period'],
                'planting_year' => $value['planting_year'],
                'employees_number' => $value['employees_number']
            ];
        }
        return res(true, 200, 'Inactive work plan listed', $data);
    }

    public function store_harvest_spraying(Request $request) {
        // return $request->All();
        $request->validate([
            'rkh_maintain_id' => 'required',
            'employee_id' => 'required',
            'harvest_amount_used' => 'required|numeric|min:1',
            'harvest_coverage' => 'required|numeric|min:1',
            'spraying_amount_used' => 'required|numeric|min:1',
            'spraying_coverage' => 'required|numeric|min:1',
            'date' => 'required',
            'maintain_time_start' => 'required',
            'maintain_time_end' => 'required',
        ]);

        $check_rkh_maintain_closed = RkhMaintain::where('id', $request->rkh_maintain_id)->where('active', 0)->first();
            if($check_rkh_maintain_closed) return res(false, 404, 'Work plan already closed');

        $check_maintain_harvest_existed = HarvestMaintain::where('rkh_maintain_id', $request->rkh_maintain_id)->where('employee_id', $request->employee_id)->first();
        $check_maintain_spraying_existed = SprayingMaintain::where('rkh_maintain_id', $request->rkh_maintain_id)->where('employee_id', $request->employee_id)->first();
            if($check_maintain_harvest_existed && $check_maintain_spraying_existed) 
                    return res(false, 404, 'Work plan already registered');

        // Check file image for harvest_image
        if ($request->hasFile('harvest_image')) {
            $request->validate([ 'harvest_image' => 'image:jpeg,png,jpg|max:2048'  ]);
            $harvest_image = $request->file('harvest_image');
            $harvest_image_folder = 'public/maintain/harvest';
            $harvest_image_name = Uuid::uuid4() . '.' . $harvest_image->getClientOriginalExtension();
            $harvest_image_mime_type = $harvest_image->getClientMimeType();
            $harvest_image_url = Storage::putFileAs($harvest_image_folder, $harvest_image, $harvest_image_name);
        } else {
            $harvest_image_name = null;
            $harvest_image_mime_type = null;
            $harvest_image_url = null;
        }

        // Check file image for harvest_image
        if ($request->hasFile('spraying_image')) {
            $request->validate([ 'spraying_image' => 'image:jpeg,png,jpg|max:2048'  ]);
            $spraying_image = $request->file('spraying_image');
            $spraying_image_folder = 'public/maintain/spraying';
            $spraying_image_name = Uuid::uuid4() . '.' . $spraying_image->getClientOriginalExtension();
            $spraying_image_mime_type = $spraying_image->getClientMimeType();
            $spraying_image_url = Storage::putFileAs($spraying_image_folder, $spraying_image, $spraying_image_name);
        } else {
            $spraying_image_name = null;
            $spraying_image_mime_type = null;
            $spraying_image_url = null;
        }

        HarvestMaintain::create([
            'rkh_maintain_id' => $request->rkh_maintain_id,
            'employee_id' => $request->employee_id,
            'amount_used' => $request->harvest_amount_used,
            'coverage' => $request->harvest_coverage,
            'date' => $request->date,
            'maintain_time_start' => $request->maintain_time_start,
            'maintain_time_end' => $request->maintain_time_end,
            'image' => $harvest_image_name,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);

        SprayingMaintain::create([
            'rkh_maintain_id' => $request->rkh_maintain_id,
            'employee_id' => $request->employee_id,
            'amount_used' => $request->spraying_amount_used,
            'coverage' => $request->spraying_coverage,
            'date' => $request->date,
            'maintain_time_start' => $request->maintain_time_start,
            'maintain_time_end' => $request->maintain_time_end,
            'image' => $spraying_image_name,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);

        // $data = [
        //     'harvest_maintain' => [
        //         'rkh_maintain_id' => $request->rkh_maintain_id,
        //         'employee_name' => $this->str_employee($request->employee_id),
        //         'amount_used' => $request->harvest_amount_used,
        //         'coverage' => $request->harvest_coverage,
        //         'date' => $request->date,
        //         'maintain_time_start' => $request->maintain_time_start,
        //         'maintain_time_end' => $request->maintain_time_end,
        //         'image' => [
        //             'name' => $harvest_image_name,
        //             'url'  => $harvest_image_url,
        //             'mime' => $harvest_image_mime_type
        //         ],
        //         'lat' => $request->lat,
        //         'lng' => $request->lng
        //     ],
        //     'spraying_maintain' => [
        //         'rkh_maintain_id' => $request->rkh_maintain_id,
        //         'employee_name' => $this->str_employee($request->employee_id),
        //         'amount_used' => $request->spraying_amount_used,
        //         'coverage' => $request->spraying_coverage,
        //         'date' => $request->date,
        //         'maintain_time_start' => $request->maintain_time_start,
        //         'maintain_time_end' => $request->maintain_time_end,
        //         'image' => [
        //             'name' => $spraying_image_name,
        //             'url'  => $spraying_image_url,
        //             'mime' => $spraying_image_mime_type
        //         ],
        //         'lat' => $request->lat,
        //         'lng' => $request->lng
        //     ],
            
        // ];

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
            'maintain_time_start' => 'required',
            'maintain_time_end'   => 'required',
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
                'maintain_time_start' => $request->maintain_time_start,
                'maintain_time_end' => $request->maintain_time_end,
                'lat' => $request->lat,
                'lng' => $request->lng
            ]);
         } catch ( \Exception $e) {
            return res(false, 404, 'Work plan invalid', $e->errorInfo);
         }
            return res(true, 200, 'Work plan added successfully');

    }

    /*
    ------------------------------------
        THIS CODE BELOW IS FOR SUPPORTING FUNCTION
    ------------------------------------
    */

    private function str_farm($farm_id) {
        $farm = Farm::find($farm_id);
        return $farm->name;
    }

    private function str_afdelling($afdelling_id) {
        $afdelling = Afdelling::find($afdelling_id);
        return $afdelling->name;
    }

    private function str_block($block_id) {
        $block = Block::find($block_id);
        return $block->name;
    }

    private function str_employee($employee_id) {
        $employee = Employee::find($employee_id);
        return $employee->name;
    }

    private function str_foreman1($foreman1_id) {
        $foreman1 = Foreman1::find($foreman1_id);
        return $foreman1->name;
    }

    private function str_foreman2($foreman2_id) {
        $foreman2 = Foreman2::find($foreman2_id);
        return $foreman2->name;
    }

}
