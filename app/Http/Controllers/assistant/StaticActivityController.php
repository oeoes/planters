<?php

namespace App\Http\Controllers\assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Block;
use App\Models\BlockStaticReference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaticActivityController extends Controller
{
    public function index() {
        $afdelling_id = auth()->guard('assistant')->user()->afdelling_id;
        $blocks = Block::where('afdelling_id', $afdelling_id)->get();
        $block_static = BlockStaticReference::where('afdelling_id', $afdelling_id)->get();
        $years = [];
        $colors = [];
        $coverages = [];
        $grand_total_coverages = 0;
        $grand_total_ages = 0;
        $grand_total_sph = 0;
        $grand_total_pblock = 0;
        $bundle_block_areas = DB::table('block_static_references')->select(DB::raw('sum(total_coverage) as total_coverage'),
                                                                           DB::raw('sum(population_coverage) as population_coverage'),
                                                                           DB::raw('sum(population_perblock) as population_perblock'),
                                                                           'planting_year')
                                                                          ->groupBy('planting_year')->get();
        foreach ($bundle_block_areas as $key => $value) {
            $years [] = [ $value->planting_year ];
            $coverages [] = [ $value->total_coverage ];
            $colors [] = '#' . substr(md5(rand()), 0, 6);
            $grand_total_coverages += $value->total_coverage;
            $grand_total_sph += $value->population_coverage;
            $grand_total_pblock += $value->population_perblock;
            $grand_total_ages += date('Y') - $value->planting_year;
        }
        return view('assistant.activity.index', [
            'blocks' => $blocks,
            'block_static' => $block_static,
            'total_coverage' => $grand_total_coverages,
            'total_sph' => $grand_total_sph,
            'total_pblock' => $grand_total_pblock,
            'total_ages' => $grand_total_ages,
            'years' => json_encode($years),
            'coverages' => json_encode($coverages),
            'colors' => json_encode($colors),
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

    public function edit(Request $request) {
        $block_static = BlockStaticReference::where('block_id', $request->block_id)->first();
        $block_static->update([
            'planting_year' => $request->pyear,
            'total_coverage' => $request->mtcov,
            'population_perblock' => $request->mpblock,
            'population_coverage' => $request->mpcov,
        ]);
        return back()->withSuccess('Task rkh telah selesai');
    }
}
