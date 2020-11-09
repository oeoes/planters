<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Farm;
use App\Models\Afdelling;
use App\Models\Block;
use App\Models\Area;

class AreaController extends Controller
{
    public function farm() {
        $farms = Farm::all();
        return view('area.farm.index', [
            'farms' => $farms
        ]);
    }

    public function farm_store(Request $request) {
        Farm::create([
            'name' => $request->farm
        ]);
        return back()->withSuccess('Farm created');
    }

    public function afdelling() {
        $afdellings = Afdelling::all();
        return view('area.afdelling.index', [
            'afdellings' => $afdellings
        ]);
    }

    public function afdelling_store(Request $request) {
        Afdelling::create([
            'name' => $request->afdelling
        ]);
        return back()->withSuccess('Afdelling created');
    }

    public function block() {
        $blocks = Block::all();
        return view('area.block.index', [
            'blocks' => $blocks
        ]);
    }

    public function block_store(Request $request) {
        Block::create([
            'name' => $request->block
        ]);
        return back()->withSuccess('block created');
    }

    public function getAfdelling(Request $request) {
        $afdellings = Area::where('farm_id', $request->farm_id)
                        ->select('afdelling_id')
                        ->distinct() // return without duplicaete
                        ->get() // select more than one
                        ->toArray(); // collection convert to array
        $afdelling = [];
        foreach ($afdellings as $value) {
            $afdelling[] = $value['afdelling_id'];
        }
        $afdellings = Afdelling::whereIn('id', $afdelling)->get();
        return response()->json($afdellings);
    }

    public function getBlock(Request $request) {
        $blocks = Area::where('afdelling_id', $request->afdelling_id)
                        ->select('block_id')
                        ->distinct()->get()->toArray();
        $block = [];
        foreach ($blocks as $value) {
            $block[] = $value['block_id'];
        }
        $block = Block::whereIn('id', $block)->get();
        return response()->json($block);
    }
}
