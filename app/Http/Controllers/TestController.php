<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Afdelling;
use App\Models\Area;
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
}
