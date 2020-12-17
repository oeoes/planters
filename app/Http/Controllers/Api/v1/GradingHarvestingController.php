<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\BlockReference;
use App\Models\Harvesting\GradingHarvesting;
use App\Models\Harvesting\EmployeeHarvesting;
use App\Models\Harvesting\HarvestingType;
use App\Models\SampleGradingHarvesting;
use Illuminate\Http\Request;

class GradingHarvestingController extends Controller
{
    public function list_samples($afdelling_id) {
        $sample_grading_harvestings = SampleGradingHarvesting::where('afdelling_id', $afdelling_id)->where('expired_at', '>=', date('Y-m-d'))->get();
        $data = [];
        foreach ($sample_grading_harvestings as $key => $value) {
            $data [] = [
                'sample_grading_id' => $value['id'],
                'planting_year' => $value['planting_year'],
                'block_id' => block($value['block_id']),
            ];
        }
        return res(true, 200, 'List samples' ,$data);
    }

    public function detail_sample($block_reference_id) {
        $harvesting = HarvestingType::where('block_ref_id', $block_reference_id)->first();
        $harvesting_date = $harvesting->date;
        $harvesting_subforeman = $harvesting->subforeman_id;
        $harvesting_employees = EmployeeHarvesting::where('harvest_id', $harvesting->id)->get();
        $block_reference = BlockReference::find($block_reference_id);
        $hk_list = [];
        foreach ($harvesting_employees as $key => $value) {
            $hk_list [] = [
                'name' => $value['name'],
                'total_harvesting' => $value['total_harvesting']
            ];
        }

        $data = [
            'date' => $harvesting_date,
            'subforeman_name' => subforeman($harvesting_subforeman)->name,
            'planting_year' => $harvesting->planting_year,
            'block_code' => block($block_reference->block_id),
            'hk_listed' => $hk_list,
        ];

        return res(true, 200, 'Detail sample', $data);
    }

    public function store_grading_harvesting(Request $request) {
        GradingHarvesting::create($request->all());
        return res(true, 200, 'Grading harvest task created');
    }

    public function list_grading_harvesting($afdelling_id) {
        $grading_harvestings = GradingHarvesting::where('afdelling_id', $afdelling_id)->orderByDesc('created_at')->get();
        $data = [];
        foreach ($grading_harvestings as $key => $value) {
            $block_reference = BlockReference::find($value['block_reference_id']);
            $block_id = $block_reference->block_id;
            $planting_year = $block_reference->planting_year;
            $data = [
                'planting_year' => $planting_year,
                'block_code'    => block($block_id),
                'hk_name'       => $value['hk_name']
            ];
        }
        return res(true, 200, 'List grading harvesting', $data);
    }
}
