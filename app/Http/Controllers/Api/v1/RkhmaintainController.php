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
            'employees_number' => 'required|numeric'
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
                        $data = [
                            'daily_work_plan' => [ 
                                'id'          => $last_rkh_maintain->id,
                                'area_id'     => $selected_area->id,
                                'farm_id'     => $request->farm_id,
                                'afdelling_id'=> $request->afdelling_id,
                                'block_id'    => $request->block_id,
                                'foreman1_id' => $request->foreman1_id,
                                'foreman1_name' => $foreman1->name,
                                'foreman2_id' => $request->foreman2_id,
                                'foreman2_name' => $foreman2->name,
                                'coverage'    => $request->coverage,
                                'population'  => $request->population,
                                'period'      => $request->fertilizer_period,
                                'planting_year'    => $request->planting_year,
                                'employees_number' => $request->employees_number,
                                'active'   => 1,
                                'harvest'  => $rkh_harvest_maintain,
                                'spraying' => $rkh_spraying_maintain,
                                'manual'   => $rkh_manual_maintain
                            ],
                        ];
        
                        return res(true, 200, 'Daily work plan successfully created', $data); 
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
        

        $foreman1 = Foreman1::find($request->foreman1_id);
        $foreman2 = Foreman2::find($close_rkh_maintain->foreman2_id);
        $harvest  = RkhHarvestMaintain::where('rkh_maintain_id', $close_rkh_maintain->id)->first();
        $spraying = RkhSprayingMaintain::where('rkh_maintain_id', $close_rkh_maintain->id)->first();
        $manual   = RkhManualMaintain::where('rkh_maintain_id', $close_rkh_maintain->id)->first();
        $area     = Area::find($close_rkh_maintain->area_id);

        // Set inactive Foreman2
        $foreman2->isactive = 0;
        $foreman2->save();

        // Set inactive RKH Maintain
        $close_rkh_maintain->decrement('active');

        $data = [
            'daily_work_plan' => [ 
                'id'            => $close_rkh_maintain->id,
                'area_id'       => $area->id,
                'farm_id'       => $area->farm_id,
                'afdelling_id'  => $area->afdelling_id,
                'block_id'      => $area->block_id,
                'foreman1_id'   => $close_rkh_maintain->foreman1_id,
                'foreman1_name' => $foreman1->name,
                'foreman2_id'   => $close_rkh_maintain->foreman2_id,
                'foreman2_name' => $foreman2->name,
                'coverage'      => $close_rkh_maintain->coverage,
                'population'    => $close_rkh_maintain->population,
                'period'        => $harvest->fertilizer_period,
                'planting_year'    => $close_rkh_maintain->planting_year,
                'employees_number' => $close_rkh_maintain->employees_number,
                'active'   => 1,
                'harvest'  => $harvest,
                'spraying' => $spraying,
                'manual'   => $manual
            ],
        ];

            return res(true, 200, 'Daily work plan successfully closed', $data);

    }

    public function foreman2_available() {
        $foremans2 = Foreman2::where('isactive', 0)->get();
            if ($foremans2->isEmpty()) 
                return res(false, 404, 'Foreman2 empty');
                return res(true, 200, 'Foreman2 listed', $foremans2);
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
            'maintain_time_start' => $request->maintain_time_start,
            'maintain_time_end' => $request->maintain_time_end,
            'image' => $spraying_image_name,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);

        $data = [
            'harvest_maintain' => [
                'rkh_maintain_id' => $request->rkh_maintain_id,
                'employee_id' => $request->employee_id,
                'amount_used' => $request->harvest_amount_used,
                'coverage' => $request->harvest_coverage,
                'maintain_time_start' => $request->maintain_time_start,
                'maintain_time_end' => $request->maintain_time_end,
                'image' => [
                    'name' => $harvest_image_name,
                    'url'  => $harvest_image_url,
                    'mime' => $harvest_image_mime_type
                ],
                'lat' => $request->lat,
                'lng' => $request->lng
            ],
            'spraying_maintain' => [
                'rkh_maintain_id' => $request->rkh_maintain_id,
                'employee_id' => $request->employee_id,
                'amount_used' => $request->spraying_amount_used,
                'coverage' => $request->spraying_coverage,
                'maintain_time_start' => $request->maintain_time_start,
                'maintain_time_end' => $request->maintain_time_end,
                'image' => [
                    'name' => $spraying_image_name,
                    'url'  => $spraying_image_url,
                    'mime' => $spraying_image_mime_type
                ],
                'lat' => $request->lat,
                'lng' => $request->lng
            ],
            
        ];

        return res(true, 200, 'Work plan added successfully', $data);

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
            'maintain_time_start' => 'required',
            'maintain_time_end'   => 'required',
        ]);

        $check_rkh_maintain_closed = RkhMaintain::where('id', $request->rkh_maintain_id)->where('active', 0)->first();
            if($check_rkh_maintain_closed) return res(false, 404, 'Work plan already closed');

        $check_maintain_manual_existed = ManualMaintain::where('rkh_maintain_id', $request->rkh_maintain_id)->where('employee_id', $request->employee_id)->first();
            if($check_maintain_manual_existed) return res(false, 404, 'Work plan already registered');

        try {
            $store_manual_maintain = ManualMaintain::create([
                'rkh_maintain_id'   => $request->rkh_maintain_id,
                'employee_id'       => $request->employee_id,
                'circle'            => $request->circle,
                'circle_coverage'   => $request->circle_coverage,
                'pruning'           => $request->pruning,
                'pruning_coverage'  => $request->pruning_coverage,
                'gawangan'          => $request->gawangan,
                'maintain_time_start' => $request->maintain_time_start,
                'maintain_time_end' => $request->maintain_time_end,
                'lat' => $request->lat,
                'lng' => $request->lng
            ]);
         } catch ( \Exception $e) {
            return res(false, 404, 'Work plan invalid', $e->errorInfo);
         }
            return res(true, 200, 'Work plan added successfully', $store_manual_maintain);

    }

}
