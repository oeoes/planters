<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\AfdellingReference;
use App\Models\Foreman;
use App\Models\Foreman1;
use Illuminate\Http\Request;

class AfdellingController extends Controller
{
    public function store_afdelling_ref(Request $request) {
        $foreman = Foreman::where('id', $request->foreman_id)->where('afdelling_id', $request->afdelling_id)->first();
        if (! $foreman) 
            return res(false, 404, 'Error invalid foreman');
        $afdelref = AfdellingReference::where('foreman_id', $request->foreman_id)->where('afdelling_id', $request->afdelling_id)->first();
        if ($afdelref)  
            return res(false, 404, 'HK Already defined');
        
        AfdellingReference::create([
            'foreman_id' => $request->foreman_id,
            'afdelling_id' => $request->afdelling_id,
            'hk_total' => $request->hk_total
        ]);

        return res(true, 200, 'HK Created');
    }
}
