<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Block;
use App\Models\Foreman2;
use App\Models\Harvesting\FruitHarvesting;
use App\Models\Harvesting\RkhHarvesting;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Storage;

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

    public function foreman1_active_rkh($foreman1_id) {
        $rkhs = RkhHarvesting::where('foreman1_id', $foreman1_id)->where('active', 1)->get();
        if ($rkhs->isEmpty()) 
            return res(false, 404, 'There is no active daily work plan');

        $data = [];
        foreach ($rkhs as $value) {
            $data [] =[
                'id' => $value['id'],
                'farm' => str_farm($value['farm_id']),
                'afdelling' => str_afdelling($value['afdelling_id']),
                'block'     => str_block($value['block_id']),
                'foreman1' => str_foreman1($value['foreman1_id']),
                'foreman2' => str_foreman2($value['foreman2_id']),
                'coverage' => $value['coverage'],
                'population' => $value['population'],
                'akp' => $value['akp'],
                'bjr' => $value['bjr'],
                'date' => $value['date'],
                'employees_number' => $value['employees_number'],
            ];
        }
        return res(true, 200, 'Active daily work plan listed', $data);
    }

    public function foreman1_inactive_rkh($foreman1_id) {
        $rkhs = RkhHarvesting::where('foreman1_id', $foreman1_id)->where('active', 0)->get();
        if ($rkhs->isEmpty()) 
            return res(false, 404, 'There is no inactive daily work plan');
        
        $data = [];
        foreach ($rkhs as $value) {
            $data [] =[
                'id' => $value['id'],
                'farm' => str_farm($value['farm_id']),
                'afdelling' => str_afdelling($value['afdelling_id']),
                'block'     => str_block($value['block_id']),
                'foreman1' => str_foreman1($value['foreman1_id']),
                'foreman2' => str_foreman2($value['foreman2_id']),
                'coverage' => $value['coverage'],
                'population' => $value['population'],
                'akp' => $value['akp'],
                'bjr' => $value['bjr'],
                'date' => $value['date'],
                'employees_number' => $value['employees_number'],
            ];
        }
        return res(true, 200, 'Inactive daily work plan listed', $data);
    }

    /*
    ------------------------------------
        THIS CODE BELOW IS FOR FOREMAN 2
    ------------------------------------
    */

    public function store_fruit_type(Request $request) {
        // return $request->all();

        $this->validate($request, [
            'rkh_harvesting_id' => 'required',
            'employee_id' => 'required',
            'date' => 'required|date|after:yesterday|date_format:Y-m-d',
            'fruit_id' => 'required',
            'harvest_target' => 'required|min:1',
            'harvest_amount' => 'required|min:1',
            'harvest_lines'  => 'required|min:1',
            'coverage_area' => 'required|min:1',
            'harvest_time_start' => 'required',
            'harvest_time_end' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        // Check file image for harvest_image
        if ($request->hasFile('report_image')) {
            $request->validate([ 'report_image' => 'image:jpeg,png,jpg|max:2048'  ]);
            $report_image = $request->file('report_image');
            $report_image_folder = 'public/harvesting/';
            $report_image_name = Uuid::uuid4() . '.' . $report_image->getClientOriginalExtension();
            $report_image_mime_type = $report_image->getClientMimeType();
            $report_image_url = Storage::putFileAs($report_image_folder, $report_image, $report_image_name);
        } else {
            $report_image_name = null;
            $report_image_mime_type = null;
            $report_image_url = null;
        }

        FruitHarvesting::create([
            'rkh_harvesting_id' => $request->rkh_harvesting_id,
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'fruit_id' => $request->fruit_id,
            'harvest_target' => $request->harvest_target,
            'harvest_amount' => $request->harvest_amount,
            'harvest_lines'  => $request->harvest_lines,
            'coverage_area' => $request->coverage_area,
            'report_image' => $report_image_name,
            'harvest_time_start' => $request->harvest_time_start,
            'harvest_time_end' => $request->harvest_time_end,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);
        
        return res(true, 200, 'Work plan added successfully');

    }
}
