<?php

namespace App\Http\Controllers\assistant;

use App\Http\Controllers\Controller;
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
                ->select(
                    'br.block_id as block_id',
                    'br.planting_year as planting_year',
                    'br.foreman_id',
                    'hs.subforeman_id',
                    'count(eh.name)',
                )->where('sgh.afdelling_id', $afdelling_id)
                 ->whereDate('expired_at', '>', date('Y-m-d'))
                 ->get();
        dd($data);
        return view('assistant.hancak.index');
    }
}
