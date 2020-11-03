<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rkh;
use App\Models\Rkhrawatpupuk;
use App\Models\Rawatpupuk;
use App\Models\Rkhrawatmanual;

class Md1Controller extends Controller
{
    public function index() {
        return view('md1.index');
    }

    public function create() {
        return view('md1.create');
    }

    public function rawat() {
        return view('md1.rawat');
    }

    public function test() {
        $rkhId = 1;
        $rkh = Rkh::find($rkhId);
        $pupukDisediakan = Rkhrawatpupuk::where('rkh_id', $rkhId)->first()->jml_pupuk;
        $totluas = Rawatpupuk::where('rkh_id', $rkhId)->sum('luas');
        $pupukDigunakan = Rawatpupuk::where('rkh_id', $rkhId)->sum('jml_terpakai');
        $presentasePupuk = (int) $pupukDigunakan / $pupukDisediakan;

        dd($rkh, $totluas, $pupukDisediakan, (int) $pupukDigunakan, $presentasePupuk * 100);
    }
}
