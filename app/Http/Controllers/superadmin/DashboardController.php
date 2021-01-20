<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Afdelling;
use App\Models\Block;
use App\Models\BlockReference;
use App\Models\Company;
use App\Models\Farm;
use App\Models\Harvesting\FillHarvesting;
use App\Models\Harvesting\HarvestingType;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        // dd(json_encode($taksasi_result), json_encode($harvesting_result));
        return view('superadmin.dashboard.index');
    }

    public function loadpanen () {
                $farms = Farm::where('company_id', 1)->get();
        $block_id = [];
        foreach ($farms as $key => $farm) {
            $afdellings = Afdelling::where('farm_id', $farm->id)->get();
                foreach($afdellings as $afdelling) {
                    $blocks = Block::where('afdelling_id', $afdelling->id)->get();
                        foreach ($blocks as $key => $value) {
                            // untuk mengambil semua block berdasarkan company
                            $block_id [] = $value->id;
                        }
                }
        }
        $harvesting_result = [];
        $taksasi_result = [];
        for ($i=0; $i < 12; $i++) { 
            $blockrefs = BlockReference::whereMonth('created_at', $i+1)->whereYear('created_at', date('Y'))
                                       ->whereIn('block_id', $block_id)->where('completed', 1)->get();

            // total taksasi per bulan
            $taksasi_val = 0;
            // total panen perbulan
            $harvesting_val = 0;
            foreach ($blockrefs as $key => $ref) {

                // untuk ambil taksasi dari tabel harvesting
                    $harvesting = HarvestingType::where('block_ref_id', $ref->id)->first();
                    $taksasi_val += $harvesting->taksasi;

                // karena 1 harvestin  = 1 fill harvesting, fill harvesting gamungkin 2.
                    $total_harvesting = FillHarvesting::where('harvest_id', $harvesting->id)->first();
                    $harvesting_val += $total_harvesting->total_harvesting; 

            }

            $taksasi_result [] = (int) $taksasi_val;
            $harvesting_result [] = (int) $harvesting_val;

        }

        return response()->json([
            'taksasi_result' => $taksasi_result,
            'harvesting_result' => $harvesting_result
        ], 200);
    }


}
