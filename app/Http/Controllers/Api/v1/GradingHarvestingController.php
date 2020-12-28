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
        $sample_grading_harvestings = SampleGradingHarvesting::where('afdelling_id', $afdelling_id)->orderByDesc('created_at')->get();
        if (! $sample_grading_harvestings)  return res(false,  404, 'List not found');

        $data = [];
        $today = date('Y-m-d');
        foreach ($sample_grading_harvestings as $key => $value) {
            (date('Y-m-d', strtotime($value['expired_at'])) >= $today) ?  $create = 1 : $create = 0;
            $data [] = [
                'sample_grading_id' => $value['id'],
                'block_reference_id' => $value['block_reference_id'],
                'planting_year' => $value['planting_year'],
                'block_code' => block($value['block_id']),
                'create' => $create,
            ];
        }
        return res(true, 200, 'List samples' , $data);
    }

    // ingin membuat pemutuan panen
    public function detail_sample($block_reference_id) {

        // This is detail simple, url in between to create grade harvesting
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
            'block_reference_id' => $block_reference_id,
            'date' => $harvesting_date,
            'subforeman_name' => subforeman($harvesting_subforeman)->name,
            'planting_year' => $block_reference->planting_year,
            'block_code' => block($block_reference->block_id),
            'hk_listed' => $hk_list,
        ];

        return res(true, 200, 'Detail sample', ['detail_harvesting' => $data ]);
    }

    public function store_grading_harvesting(Request $request) {
        $grading_harvesting = GradingHarvesting::create($request->all());
        $data = [
            'grading_harvesting_id' => $grading_harvesting->id
        ];
        return res(true, 200, 'Sample Grading Harvest Created', $data);
    }

    public function list_grading_harvesting($sample_grading_id) {
        $grading_harvestings = GradingHarvesting::where('sample_grading_id', $sample_grading_id)->get();

        if (! $grading_harvestings)  return res(false,  404, 'List not found');

        $grading_list = [];
        foreach ($grading_harvestings as $key => $value) {
            $grading_list [] = [
                // 'sample' => 'Sample '.$sample,
                'grading_harvesting_id' => $value['id']
            ];
        }
        return res(true, 200, 'List grading harvesting', $grading_list);    
    }

    public function detail_grading_harvesting($block_reference_id, $grading_harvesting_id) {
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

        $detail_harvesting = [
            'date' => $harvesting_date,
            'subforeman_name' => subforeman($harvesting_subforeman)->name,
            'planting_year' => $block_reference->planting_year,
            'block_code' => block($block_reference->block_id),
            'hk_listed' => $hk_list,
        ];

        $grading_harvesting = GradingHarvesting::find($grading_harvesting_id);
        $detail_grading_harvesting = [
            'date' => $grading_harvesting->date,
            'harvesting_bunch' => $grading_harvesting->harvesting_bunch,
            'unharvesting_bunch' => $grading_harvesting->unharvesting_bunch,
            'bunch_leaves' => $grading_harvesting->bunch_leaves,
            'in_circle' => $grading_harvesting->in_circle,
            'out_circle' => $grading_harvesting->out_circle,
            'on_palm' => $grading_harvesting->on_palm,
            'harvesting_path' => $grading_harvesting->harvesting_path,
            'hk_name' => $grading_harvesting->hk_name,
            'note' => $grading_harvesting->note
        ];

        $data = [
            'detail_harvesting' => $detail_harvesting,
            'detail_grading_harvesting' => $detail_grading_harvesting
        ];

        return res(true, 200, 'Detail grading harvesting', $data);
    }
}
