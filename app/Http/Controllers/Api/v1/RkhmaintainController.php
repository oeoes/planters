<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\Afdelling;
use App\Models\Block;
use App\Models\Area;
use App\Models\Maintain\RkhMaintain;
use App\Models\Maintain\RkhHarvestMaintain;
use App\Models\Maintain\RkhSprayingMaintain;
use App\Models\Maintain\RkhManualMaintain;
use Ramsey\Uuid\Uuid;
use App\Models\Foreman1;
use App\Models\Foreman2;

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

}
