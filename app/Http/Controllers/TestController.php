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
        $a = HarvestSpraying::where('rkh_maintain_id', $rkh_maintain_id);
        $b = ManualMaintain::where('rkh_maintain_id', $rkh_maintain_id)->union($a)->get();
        $result = $b;
    }
}
