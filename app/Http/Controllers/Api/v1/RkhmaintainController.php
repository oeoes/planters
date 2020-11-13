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

class RkhmaintainController extends Controller
{
    public function store(Request $request) {
        // return response()->json($request->all());
        // 1. generate rkh mainain
        // 2. generate harvest
        // 3. generate spray
        // 4. generate manual
        // 5. set active foreman 2
        $selected_area = Area::where('farm_id', $request->farm_id)
                             ->where('afdelling_id', $request->afdelling_id)
                             ->where('block_id', $request->block_id)
                             ->get();
        return $selected_area;
    }
}
