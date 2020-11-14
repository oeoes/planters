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

        $rkh_maintain = RkhMaintain::create([
            'id'          => Uuid::uuid4(),
            'area_id'     => $selected_area->id,
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
                $rkh_spraying_maintain = RkhSprayingMaintain::create([
                    'rkh_maintain_id' => $last_rkh_maintain->id,
                    'spraying_type'   => $request->spraying_type,
                    'spraying_amount' => $request->spraying_amount
                ]);

                if ($rkh_spraying_maintain) {
                    $rkh_manual_maintain = RkhManualMaintain::create([
                        'rkh_maintain_id' => $last_rkh_maintain->id,
                        'circle' => $request->manual_circle,
                        'pruning' => $request->manual_pruning,
                        'gawangan' => $request->manual_gawangan
                    ]);
                }
                $data = [
                    'daily_work_plan' => $rkh_maintain,
                    'harvest'  => $rkh_harvest_maintain,
                    'spraying' => $rkh_spraying_maintain,
                    'manual'   => $rkh_manual_maintain
                ];

                return res(true, 200, 'Daily work plan successfully created', $data); 
            }
        }
    }

    public function check(Request $request) {
        $foreman1_id = $request->foreman1_id;
        $check_active_rkh_maintain = RkhMaintain::where('foreman1_id', $foreman1_id)->where('active', 1)->first();
        if(! $check_active_rkh_maintain) {
            return res(false, 400, 'Daily work plan active not found');
        }
            return res(true, 200, 'Daily work plan already running', $check_active_rkh_maintain);
    }

    public function close(Request $request) {
        $close_rkh_maintain = RkhMaintain::where('foreman1_id', $request->foreman1_id)
                            ->where('id', $request->rkh_maintain_id)
                            ->where('active', 1)
                            ->first();
                            // return $request->all();
        if (! $close_rkh_maintain) {
            return res(false, 400, 'Daily work plan not found');
        }
        $close_rkh_maintain->decrement('active');
            return res(true, 200, 'Daily work plan successfully closed', $close_rkh_maintain);

    }
}
