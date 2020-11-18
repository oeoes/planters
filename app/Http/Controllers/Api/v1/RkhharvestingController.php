<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Block;
use App\Models\Foreman2;
use App\Models\Harvesting\RkhHarvesting;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class RkhharvestingController extends Controller
{
    /*
    ------------------------------------
        THIS CODE BELOW IS FOR FOREMAN 1
    ------------------------------------
    */

    public function store(Request $request) {

        $request->validate([
            'farm_id'          => 'required|numeric',
            'afdelling_id'     => 'required|numeric',
            'block_id'         => 'required|numeric',
            'foreman1_id'      => 'required|numeric',
            'foreman2_id'      => 'required|numeric',
            'coverage'         => 'required|numeric',
            'population'       => 'required|numeric',
            'employees_number' => 'required|numeric',
            'akp'              => 'required|numeric',
            'bjr'              => 'required|numeric',
        ]);

        $foreman2_exist = Foreman2::find($request->foreman2_id);
        if ($foreman2_exist->isactive == 1) 
            return res(false, 404, 'This foreman2 is on working');

        $active_block = RkhHarvesting::where('block_id', $request->block_id)->where('active', 1)->first();
        if ($active_block) 
            return res(false, 404, 'This daily work plan already running');

        $selected_area = Area::where('farm_id', $request->farm_id)->where('afdelling_id', $request->afdelling_id)->where('block_id', $request->block_id)->first();
        if (! $selected_area) 
            return res(false, 404, 'Invalid selected farm, afdelling, or block.');

        RkhHarvesting::create([
            'id'          => Uuid::uuid4(),
           'area_id' => $selected_area->id,
           'farm_id'     => $request->farm_id,
           'afdelling_id'=> $request->afdelling_id,
           'block_id'    => $request->block_id,
           'foreman1_id' => $request->foreman1_id,
           'foreman2_id' => $request->foreman2_id,
           'coverage'    => $request->coverage,
           'population'  => $request->population,
           'date' => $request->date,
           'akp'  => 12.1,
           'bjr'  => 12.12,
           'employees_number' => 12
        ]);

        $foreman2 = Foreman2::find($request->foreman2_id);
        $foreman2->isactive = 1;
        $foreman2->save();

        return res(true, 200, 'Daily work plan successfully created');
    }

    public function close(Request $request) {
        // return $request->all();

        $close_rkh_harvesting = RkhHarvesting::where('foreman1_id', $request->foreman1_id)
                                ->where('id', $request->rkh_harvesting_id)
                                ->where('active', 1)
                                ->first();
            

        if (! $close_rkh_harvesting)
            return res(false, 404, 'Daily work plan not found');

        // Set inactive Foreman2
        $foreman2 = Foreman2::find($close_rkh_harvesting->foreman2_id);
                    $foreman2->isactive = 0;
                    $foreman2->save();

        // Set inactive RKH harvesting
        $close_rkh_harvesting->decrement('active');
        return res(true, 200, 'Daily work plan successfully closed');
    }

    public function foreman1_active_rkh() {
        
    }
}
