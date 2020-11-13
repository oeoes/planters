<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\Afdelling;
use App\Models\Block;
use App\Models\Area;

class AreaController extends Controller
{
    public function farm() {
        $farms = Farm::all();
        return res(true, 200, 'Farm listed', $farms);
    }

    public function select_afdelling($farm_id) {
        $afdelling_ids = Area::where('farm_id', $farm_id)
                             ->distinct()
                             ->get('afdelling_id');
        $afdellings = Afdelling::whereIn('id', $afdelling_ids)->get();
        return res(true, 200, 'Afdellings listed', $afdellings);
    }

    public function select_block($farm_id, $afdelling_id) {
        $block_ids = Area::where('farm_id', $farm_id)
                         ->where('afdelling_id', $afdelling_id)
                         ->get();
        $blocks = Block::whereIn('id', $block_ids)->get();
        if($block_ids->isEmpty()) { 
            return res(false, 400, 'Blocks invalid');
        } else {
            return res(true, 200, 'Blocks listed', $blocks);
        }
    }

}
