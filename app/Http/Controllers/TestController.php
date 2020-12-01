<?php

namespace App\Http\Controllers;

use App\Models\Foreman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subforeman;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function allsfm() {
        $subforemans = Subforeman::all();
        return $subforemans;
    }

    public function allfm() {
        $foremans = Foreman::all();
        return $foremans;
    }
}
