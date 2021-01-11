<?php

namespace App\Http\Controllers\assistant;

use App\Http\Controllers\Controller;
use App\Models\Harvesting\GradingHarvesting;
use App\Models\SampleGradingHarvesting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AncakController extends Controller
{
    public function index () {
        $afdelling_id = auth('assistant')->user()->afdelling_id;
        // join block reference, sample grading, harvesting, fill harvesint
        $data = DB::table('sample_grading_harvestings as sgh')
                ->join('block_references as br', 'br.id', '=', 'sgh.block_reference_id')
                ->join('harvestings as hs', 'hs.block_ref_id', '=', 'br.id')
                // ->join('fill_harvestings as fh', 'fh.harvest_id', '=', 'hs.id')
                ->join('employee_harvestings as eh', 'eh.harvest_id', '=', 'hs.id')
                ->join('grading_harvestings as gh', 'gh.sample_grading_id', '=', 'sgh.id')
                ->select(
                    'sgh.id as id',
                    'sgh.date as date',
                    'br.block_id as block_id',
                    'br.planting_year as planting_year',
                    'br.foreman_id',
                    // DB::raw('count(gh.sample_grading_id) as employee_fill'),
                    DB::raw('count(eh.harvest_id) as employees'),
                )
                 ->groupBy('sgh.id')
                 ->where('sgh.afdelling_id', $afdelling_id)
                 ->whereDate('expired_at', '>', date('Y-m-d'))
                 ->orderByDesc('sgh.created_at')
                 ->get();
                
        return view('assistant.hancak.index', [
            'data' => $data
        ]);
    }

    public function list ($sample_grading_id, $hvs_date) {
        $sampleExisted = SampleGradingHarvesting::where('date', $hvs_date)->where('id', $sample_grading_id)->first();
        if (empty($sampleExisted)) 
            return redirect()->route('assistant.hancak.index')->withError('Daftar pemutuan hancak tidak valid');

        $gradings = GradingHarvesting::where('sample_grading_id', $sample_grading_id)->orderByDesc('created_at')->get();
        return view('assistant.hancak.list', [
            'gradings' => $gradings,
            'hvs_date' => $hvs_date,
            'block_id' => $sampleExisted->block_id,
        ]);
    }  

}
