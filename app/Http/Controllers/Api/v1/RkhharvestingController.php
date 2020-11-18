<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Foreman2;
use App\Models\Harvesting\RkhHarvesting;
use Illuminate\Http\Request;

class RkhharvestingController extends Controller
{
    /*
    ------------------------------------
        THIS CODE BELOW IS FOR FOREMAN 1
    ------------------------------------
    */

    public function store(Request $request) {
        return $request->all();

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
            return res(false, 404, 'This foreman2 is on working', $foreman2_exist);

        $rkh_exist = RkhHarvesting::where('block_id', $request->block_id)->first();
        if ($rkh_exist)
            return res(false, 404, 'Daily work plan already created');

        $selected_area = Area::where('farm_id', $request->farm_id)->where('afdelling_id', $request->afdelling_id)->where('block_id', $request->block_id)->first();
        if (! $selected_area) 
            return res(false, 404, 'Invalid selected farm, afdelling, or block.');

        $foreman2 = Foreman2::find($request->foreman2_id);
        $foreman2->isactive = 1;
        $foreman2->save();
    }
}
