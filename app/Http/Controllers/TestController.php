<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Afdelling;
use App\Models\Area;
use App\Models\Foreman1;
use App\Models\Foreman2;
use App\Models\Maintain\HarvestSpraying;
use App\Models\Maintain\ManualMaintain;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function each() {
        $area = Area::where('farm_id', 1)->select('afdelling_id')->distinct()->get()->toArray();
        dd($area);
    }

    public function test() {
        $data = Area::all();
        return $data;
    }

    public function img() {
        $a = Storage::disk('public')->put('/images/file.txt', 'contents');
        return Storage::get('images/file.txt');
    }

    public function fm1() {
        $fms = Foreman1::all();
        return response()->json($fms);
    }

    public function fm2 (){
        $fms = Foreman2::all();
        return response()->json($fms);
    }

    public function sql() {
        $rkh_maintain_id = 'e6f66739-ea44-4470-b626-624a3a9dc5b7';
        $db = DB::select("select 
                                circle, 
                                circle_coverage, 
                                null,
                                created_at 
                          from manual_maintains where rkh_maintain_id='692172a0-5253-404c-9064-919e3c479f01'
                          union all 
                          select 
                                harvest_amount, 
                                harvest_coverage, 
                                date,
                                created_at 
                          from harvest_spraying where rkh_maintain_id='692172a0-5253-404c-9064-919e3c479f01' 
 
                          order by created_at DESC"
                        );
        return $db;
    }

    /*
                select 
                    harvest_amount AS ha, 
                    harvest_coverage AS hc, 
                    created_at
                from harvest_spraying where rkh_maintain_id = "692172a0-5253-404c-9064-919e3c479f01"
                union all
                select 
                    circle AS ha,         
                    circle_coverage AS hc,             
                    created_at 
                from manual_maintains where rkh_maintain_id = "692172a0-5253-404c-9064-919e3c479f01"

                order by created_at
    */

    public function arr() {
        $rkh_maintain_id = '692172a0-5253-404c-9064-919e3c479f01';
        $hs = HarvestSpraying::where('rkh_maintain_id', $rkh_maintain_id)->get()->toArray();
        $mm = ManualMaintain::where('rkh_maintain_id', $rkh_maintain_id)->get()->toArray();
        $a = collect(array_merge($hs, $mm))->sortByDesc('created_at');
        return $a;
        
        // $arrayOne = array(
        //     array(
        //         'date'      => '2012-01-10',
        //         'result '   => 65,
        //         'name'      => 'Les oc&eacute;ans'
        //     ),
        //     array(
        //         'date'      => '2012-01-13',
        //         'result '   => 66,
        //         'name'      => 'Les continents',
        //         'type'      => 'Scores'
        //     )
        // );
        
        // $arrayTwo = array(
        //     array(
        //         'date'      => '2012-01-12',
        //         'result '   => 60,
        //         'name'      => 'Step#1',
        //         'type'      => 'Summary'
        //     )
        // );

        // function cmp($a, $b){
        //     $ad = strtotime($a['date']);
        //     $bd = strtotime($b['date']);
        //     return ($ad-$bd);
        // }

        // $arr = array_merge($arrayOne, $arrayTwo);
        // return usort($arr, [$this, 'cmp']);
        
    }


    
}
