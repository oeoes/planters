<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\BlockReference;
use App\Models\Foreman;
use App\Models\Maintain\CircleType;
use App\Models\Maintain\FertilizerType;
use App\Models\Maintain\GawanganType;
use App\Models\Maintain\PruningType;
use App\Models\Maintain\SprayingType;
use App\Models\PestControl;
use App\Models\Subforeman;
use Illuminate\Http\Request;

class DwpmaintainController extends Controller
{
    public function store_spraying(Request $request) {
        foreach ($request->except('foreman_note') as $data => $value) {
            $valids[$data] = "required";
        }
        $request->validate($valids);

        $subforeman = Subforeman::where('id', $request->subforeman_id)->where('active', 0)->where('afdelling_id', foreman()->afdelling_id)->first();
        if (! $subforeman) 
            return res(false, 404, 'Invalid subforeman');

        $blockrefs = BlockReference::where('id', $request->block_ref_id)->where('foreman_id', $request->foreman_id)->first();
        if (! $blockrefs)
            return res(false, 404, 'Wrong foreman or block references');

        if ($blockrefs->jobtype_id != 1 || $subforeman->jobtype_id != 1) 
                return res(false, 404, 'Wrong job type', [$blockrefs->jobtype_id, $subforeman->jobtype_id]);

        $spraying = SprayingType::where('block_ref_id', $request->block_ref_id)->where('foreman_id', $request->foreman_id)->latest()->first();
        if ($spraying) {
            // if spraying created less 1
            if ($spraying->date == $request->date || $spraying->completed == 0)
            return res(false, 404, 'Cannot do next, please fill this form first!');
        }

        SprayingType::create([
            'block_ref_id' => $request->block_ref_id,
            'foreman_id' => $request->foreman_id,
            'subforeman_id'=> $request->subforeman_id,
            'date' => $request->date,
            'type' => $request->type,
            'qty' => $request->qty,
            'target'  => $request->target,
            'hk_used' => $request->hk_used,
            'foreman_note' => $request->foreman_note
        ]);

        $subforeman->increment('active');
        $subforeman->save();

        return res(true, 200, 'Daily work plan spraying added');
    }

    public function store_fertilizer(Request $request) {
        foreach ($request->except('foreman_note') as $data => $value) {
            $valids[$data] = "required";
        }
        $request->validate($valids);

        $subforeman = Subforeman::where('id', $request->subforeman_id)->where('active', 0)->where('afdelling_id', foreman()->afdelling_id)->first();
        if (! $subforeman) 
            return res(false, 404, 'Invalid subforeman');

        $blockrefs = BlockReference::where('id', $request->block_ref_id)->where('foreman_id', $request->foreman_id)->first();
        if (! $blockrefs)
            return res(false, 404, 'Wrong foreman or block references');

        if ($blockrefs->jobtype_id != 2 || $subforeman->jobtype_id != 2) 
                return res(false, 404, 'Wrong job type', [$blockrefs->jobtype_id, $subforeman->jobtype_id]);

        $fertilizer = FertilizerType::where('block_ref_id', $request->block_ref_id)->where('foreman_id', $request->foreman_id)->latest()->first();
        if ($fertilizer) {
            // if fertilizer created less 1
            if ($fertilizer->date == $request->date || $fertilizer->completed == 0)
            return res(false, 404, 'Cannot do next, please fill this form first!');
        }

        FertilizerType::create([
            'block_ref_id' => $request->block_ref_id,
            'foreman_id' => $request->foreman_id,
            'subforeman_id'=> $request->subforeman_id,
            'date' => $request->date,
            'type' => $request->type,
            'qty' => $request->qty,
            'target'  => $request->target,
            'hk_used' => $request->hk_used,
            'foreman_note' => $request->foreman_note
        ]);

        $subforeman->increment('active');
        $subforeman->save();

        return res(true, 200, 'Daily work plan fertilizer added');
    }

    public function store_pcontrol(Request $request) {
        foreach ($request->except('foreman_note') as $data => $value) {
            $valids[$data] = "required";
        }
        $request->validate($valids);

        $subforeman = Subforeman::where('id', $request->subforeman_id)->where('active', 0)->where('afdelling_id', foreman()->afdelling_id)->first();
        if (! $subforeman) 
            return res(false, 404, 'Invalid subforeman');

        $blockrefs = BlockReference::where('id', $request->block_ref_id)->where('foreman_id', $request->foreman_id)->first();
        if (! $blockrefs)
            return res(false, 404, 'Wrong foreman or block references');

        if ($blockrefs->jobtype_id != 6 || $subforeman->jobtype_id != 6) 
                return res(false, 404, 'Wrong job type', [$blockrefs->jobtype_id, $subforeman->jobtype_id]);

        $pestcontrol = PestControl::where('block_ref_id', $request->block_ref_id)->where('foreman_id', $request->foreman_id)->latest()->first();
        if ($pestcontrol) {
            // if pestcontrol created less 1
            if ($pestcontrol->date == $request->date || $pestcontrol->completed == 0)
            return res(false, 404, 'Cannot do next, please fill this form first!');
        }

        PestControl::create([
            'block_ref_id' => $request->block_ref_id,
            'foreman_id' => $request->foreman_id,
            'subforeman_id'=> $request->subforeman_id,
            'date' => $request->date,
            'type' => $request->type,
            'qty' => $request->qty,
            'target'  => $request->target,
            'hk_used' => $request->hk_used,
            'foreman_note' => $request->foreman_note
        ]);

        $subforeman->increment('active');
        $subforeman->save();

        return res(true, 200, 'Daily work plan pest control added');
    }

    public function store_mcircle(Request $request) {
        foreach ($request->except('foreman_note') as $data => $value) {
            $valids[$data] = "required";
        }
        $request->validate($valids);

        $subforeman = Subforeman::where('id', $request->subforeman_id)->where('active', 0)->where('afdelling_id', foreman()->afdelling_id)->first();
        if (! $subforeman) 
            return res(false, 404, 'Invalid subforeman');

        $blockrefs = BlockReference::where('id', $request->block_ref_id)->where('foreman_id', $request->foreman_id)->first();
        if (! $blockrefs)
            return res(false, 404, 'Wrong foreman or block references');

        if ($blockrefs->jobtype_id != 3 || $subforeman->jobtype_id != 3) 
                return res(false, 404, 'Wrong job type', [$blockrefs->jobtype_id, $subforeman->jobtype_id]);

        $circle = CircleType::where('block_ref_id', $request->block_ref_id)->where('foreman_id', $request->foreman_id)->latest()->first();
        if ($circle) {
            // if circle created less 1
            if ($circle->date == $request->date || $circle->completed == 0)
            return res(false, 404, 'Cannot do next, please fill this form first!');
        }

        CircleType::create([
            'block_ref_id' => $request->block_ref_id,
            'foreman_id' => $request->foreman_id,
            'subforeman_id'=> $request->subforeman_id,
            'date' => $request->date,
            'target'  => $request->target,
            'hk_used' => $request->hk_used,
            'foreman_note' => $request->foreman_note
        ]);

        return res(true, 200, 'Daily work plan manual circle added');

    }

    public function store_mpruning(Request $request) {
        foreach ($request->except('foreman_note') as $data => $value) {
            $valids[$data] = "required";
        }
        $request->validate($valids);

        $subforeman = Subforeman::where('id', $request->subforeman_id)->where('active', 0)->where('afdelling_id', foreman()->afdelling_id)->first();
        if (! $subforeman) 
            return res(false, 404, 'Invalid subforeman');

        $blockrefs = BlockReference::where('id', $request->block_ref_id)->where('foreman_id', $request->foreman_id)->first();
        if (! $blockrefs)
            return res(false, 404, 'Wrong foreman or block references');

        if ($blockrefs->jobtype_id != 4 || $subforeman->jobtype_id != 4) 
                return res(false, 404, 'Wrong job type', [$blockrefs->jobtype_id, $subforeman->jobtype_id]);

        $pruning = PruningType::where('block_ref_id', $request->block_ref_id)->where('foreman_id', $request->foreman_id)->latest()->first();
        if ($pruning) {
            // if pruning created less 1
            if ($pruning->date == $request->date || $pruning->completed == 0)
            return res(false, 404, 'Cannot do next, please fill this form first!');
        }

        PruningType::create([
            'block_ref_id' => $request->block_ref_id,
            'foreman_id' => $request->foreman_id,
            'subforeman_id'=> $request->subforeman_id,
            'date' => $request->date,
            'target'  => $request->target,
            'hk_used' => $request->hk_used,
            'foreman_note' => $request->foreman_note
        ]);

        return res(true, 200, 'Daily work plan pruning added');
    }

    public function store_mgawangan(Request $request) {
        foreach ($request->except('foreman_note') as $data => $value) {
            $valids[$data] = "required";
        }
        $request->validate($valids);

        $subforeman = Subforeman::where('id', $request->subforeman_id)->where('active', 0)->where('afdelling_id', foreman()->afdelling_id)->first();
        if (! $subforeman) 
            return res(false, 404, 'Invalid subforeman');

        $blockrefs = BlockReference::where('id', $request->block_ref_id)->where('foreman_id', $request->foreman_id)->first();
        if (! $blockrefs)
            return res(false, 404, 'Wrong foreman or block references');

        if ($blockrefs->jobtype_id != 5 || $subforeman->jobtype_id != 5) 
                return res(false, 404, 'Wrong job type for block', [$blockrefs->jobtype_id, $subforeman->jobtype_id]);

        $gawangan = GawanganType::where('block_ref_id', $request->block_ref_id)->where('foreman_id', $request->foreman_id)->latest()->first();
        if ($gawangan) {
            // if gawangan created less 1
            if ($gawangan->date == $request->date || $gawangan->completed == 0)
            return res(false, 404, 'Cannot do next, please fill this form first!');
        }

        GawanganType::create([
            'block_ref_id' => $request->block_ref_id,
            'foreman_id' => $request->foreman_id,
            'subforeman_id'=> $request->subforeman_id,
            'date' => $request->date,
            'target'  => $request->target,
            'hk_used' => $request->hk_used,
            'foreman_note' => $request->foreman_note
        ]);

        return res(true, 200, 'Daily work plan pruning added');
    }

    public function active_subforeman($jobtype_id) { 
        // located on foreman route / area
        // active = 0, where standby
        $subforeman = Subforeman::where('jobtype_id', $jobtype_id)
                     ->where('afdelling_id', foreman()->afdelling_id)
                     ->where('active', 0)->get();
        if ($subforeman->isEmpty()) 
            return res(false, 404, "All subforeman were working");
            return res(true, 200, 'Subforeman listed', $subforeman);


    }

    // For mandor bidang
    public function fill_spraying() {
        
    }

}
