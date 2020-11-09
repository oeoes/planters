<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Afdelling;
use App\Models\Area;

class TestController extends Controller
{
    public function each() {
        $area = Area::where('farm_id', 1)->select('afdelling_id')->distinct()->get()->toArray();
        dd($area);
    }
}
