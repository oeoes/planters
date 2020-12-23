<?php

namespace App\Http\Controllers\assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Block;
use App\Models\BlockStaticReference;
use Illuminate\Support\Facades\Auth;

class StaticActivityController extends Controller
{
    public function index() {
        $afdelling_id = auth()->guard('assistant')->user()->afdelling_id;
        $blocks = Block::where('afdelling_id', $afdelling_id)->get();
        $block_static = BlockStaticReference::whereIn('block_id', $blocks)->get();
        // dd($block_static);
        return view('assistant.activity.index', [
            'blocks' => $blocks,
            'block_static' => $block_static
        ]);
    }

    public function store(Request $request) {
        $isExists = BlockStaticReference::where('block_id', $request->block_id)->first();
        if ($isExists) return back()->withError('Aktivitas area sudah dibuat sebelumnya');
        BlockStaticReference::create([
            'block_id' => $request->block_id,
            'afdelling_id' => Auth::guard('assistant')->user()->afdelling_id,
            'planting_year' => $request->pyear,
            'total_coverage' => $request->tcov,
            'available_coverage' => 0,
            'population_coverage' => $request->pcov,
            'population_perblock' => $request->pblock,
        ]);
        return back()->withSuccess('Aktivitas area tertentu dibuat!');
    }
}
