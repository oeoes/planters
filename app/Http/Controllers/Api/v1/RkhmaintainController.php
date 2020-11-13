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
            'period'      => $request->period,
            'planting_year'    => $request->planting_year,
            'employees_number' => $request->employees_number,
            'status' => 1,
        ]);
        
        if ($rkh_maintain) {
            $last_rkh_maintain = RkhMaintain::where('foreman1_id', $request->foreman1_id)
                                            ->where('status', 1)
                                            ->latest()
                                            ->first();
            return $last_rkh_maintain;
            // RkhHarvestMaintain
        }

    }
}
