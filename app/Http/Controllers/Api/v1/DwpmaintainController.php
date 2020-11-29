<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\BlockReference;
use App\Models\Foreman;
use App\Models\Maintain\CircleType;
use App\Models\Maintain\FertilizerType;
use App\Models\Maintain\FillFertilizer;
use App\Models\Maintain\FillSpraying;
use App\Models\Maintain\GawanganType;
use App\Models\Maintain\PruningType;
use App\Models\Maintain\SprayingType;
use App\Models\Maintain\PestControl;
use App\Models\Subforeman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use Ramsey\Uuid\Uuid;

class DwpmaintainController extends Controller
{
    public function store_spraying(Request $request) {
        $validator = Validator::make($request->all(), [
            'block_ref_id' => 'required',
            'foreman_id' => 'required',
            'subforeman_id' => 'required',
            'date' => 'required',
            'type' => 'required',
            'target_coverage' => 'required', 
            'ingredients_amount' => 'required',
            'hk_used' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors()->first());

        $subforeman = Subforeman::where('id', $request->subforeman_id)->where('active', 0)->where('afdelling_id', foreman($request->foreman_id)->afdelling_id)->first();
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

        SprayingType::create($request->all());

        $subforeman->increment('active');
        $subforeman->save();

        $data = [
            'block_ref_id' => (int) $request->block_ref_id,
            'foreman_name' => (int) foreman($request->foreman_id)->name,
            'subforeman_id'=> (int) subforeman($request->subforeman_id)->name,
            'date' => $request->date,
            'type' => $request->type,
            'target'  => (float) $request->target,
            'hk_used' => (float)$request->hk_used,
            'foreman_note' => $request->foreman_note
        ];

        return res(true, 200, 'Daily work plan spraying added', $data);
    }

    public function store_fertilizer(Request $request) {
        $validator = Validator::make($request->all(), [
            'block_ref_id' => 'required',
            'foreman_id' => 'required',
            'subforeman_id' => 'required',
            'date' => 'required',
            'type' => 'required',
            'target_coverage' => 'required', 
            'ingredients_amount' => 'required',
            'hk_used' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors()->first());

        $subforeman = Subforeman::where('id', $request->subforeman_id)->where('active', 0)->where('afdelling_id', foreman($request->foreman_id)->afdelling_id)->first();
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

        FertilizerType::create($request->all());

        $subforeman->increment('active');
        $subforeman->save();

        $data = [
            'block_ref_id' => (int) $request->block_ref_id,
            'foreman_name' => (int) foreman($request->foreman_id)->name,
            'subforeman_id'=> (int) subforeman($request->subforeman_id)->name,
            'date' => $request->date,
            'type' => $request->type,
            'target'  => (float) $request->target,
            'hk_used' => (float) $request->hk_used,
            'foreman_note' => $request->foreman_note
        ];

        return res(true, 200, 'Daily work plan fertilizer added', $data);
    }

    public function store_pcontrol(Request $request) {
        $validator = Validator::make($request->all(), [
            'block_ref_id' => 'required',
            'foreman_id' => 'required',
            'subforeman_id' => 'required',
            'date' => 'required',
            'type' => 'required',
            'target_coverage' => 'required', 
            'ingredients_amount' => 'required',
            'hk_used' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors()->first());

        $subforeman = Subforeman::where('id', $request->subforeman_id)->where('active', 0)->where('afdelling_id', foreman($request->foreman_id)->afdelling_id)->first();
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

        PestControl::create($request->all());

        $subforeman->increment('active');
        $subforeman->save();

        $data = [
            'block_ref_id' => (int) $request->block_ref_id,
            'foreman_name' => (int) foreman($request->foreman_id)->name,
            'subforeman_id'=> (int) subforeman($request->subforeman_id)->name,
            'date' => $request->date,
            'type' => $request->type,
            'target'  => (float) $request->target,
            'hk_used' => (float)$request->hk_used,
            'foreman_note' => $request->foreman_note
        ];

        return res(true, 200, 'Daily work plan pest control added', $data);
    }

    public function store_mcircle(Request $request) {
        $validator = Validator::make($request->all(), [
            'block_ref_id' => 'required',
            'foreman_id' => 'required',
            'subforeman_id' => 'required',
            'date' => 'required',
            'type' => 'required',
            'target_coverage' => 'required', 
            'ingredients_amount' => 'required',
            'hk_used' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors()->first());

        $subforeman = Subforeman::where('id', $request->subforeman_id)->where('active', 0)->where('afdelling_id', foreman($request->foreman_id)->afdelling_id)->first();
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

        CircleType::create($request->all());

        $subforeman->increment('active');
        $subforeman->save();

        $data = [
            'block_ref_id' => (int) $request->block_ref_id,
            'foreman_name' => (int) foreman($request->foreman_id)->name,
            'subforeman_id'=> (int) subforeman($request->subforeman_id)->name,
            'date' => $request->date,
            'target'  => (float) $request->target,
            'hk_used' => (float)$request->hk_used,
            'foreman_note' => $request->foreman_note
        ];

        return res(true, 200, 'Daily work plan manual circle added', $data);

    }

    public function store_mpruning(Request $request) {
        $validator = Validator::make($request->all(), [
            'block_ref_id' => 'required',
            'foreman_id' => 'required',
            'subforeman_id' => 'required',
            'date' => 'required',
            'type' => 'required',
            'target_coverage' => 'required', 
            'ingredients_amount' => 'required',
            'hk_used' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors()->first());

        $subforeman = Subforeman::where('id', $request->subforeman_id)->where('active', 0)->where('afdelling_id', foreman($request->foreman_id)->afdelling_id)->first();
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

        PruningType::create($request->all());

        $subforeman->increment('active');
        $subforeman->save();

        $data = [
            'block_ref_id' => (int) $request->block_ref_id,
            'foreman_name' => (int) foreman($request->foreman_id)->name,
            'subforeman_id'=> (int) subforeman($request->subforeman_id)->name,
            'date' => $request->date,
            'target'  => (float) $request->target,
            'hk_used' => (float)$request->hk_used,
            'foreman_note' => $request->foreman_note
        ];

        return res(true, 200, 'Daily work plan pruning added', $data);
    }

    public function store_mgawangan(Request $request) {
        $validator = Validator::make($request->all(), [
            'block_ref_id' => 'required',
            'foreman_id' => 'required',
            'subforeman_id' => 'required',
            'date' => 'required',
            'type' => 'required',
            'target_coverage' => 'required', 
            'ingredients_amount' => 'required',
            'hk_used' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors()->first());

        $subforeman = Subforeman::where('id', $request->subforeman_id)->where('active', 0)->where('afdelling_id', foreman($request->foreman_id)->afdelling_id)->first();
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

        GawanganType::create($request->all());

        $subforeman->increment('active');
        $subforeman->save();

        $data = [
            'block_ref_id' => (int) $request->block_ref_id,
            'foreman_name' => (int) foreman($request->foreman_id)->name,
            'subforeman_id'=> (int) subforeman($request->subforeman_id)->name,
            'date' => $request->date,
            'target'  => (float) $request->target,
            'hk_used' => (float)$request->hk_used,
            'foreman_note' => $request->foreman_note
        ];

        return res(true, 200, 'Daily work plan pruning added', $data);
    }

    public function active_subforeman($jobtype_id, $afdelling_id) { 
        // located on foreman route / area
        // active = 0, where standby
        $subforeman = Subforeman::where('jobtype_id', $jobtype_id)
                     ->where('afdelling_id', $afdelling_id)
                     ->where('active', 0)->get();
        if ($subforeman->isEmpty()) 
            return res(false, 404, "All subforeman were working");
            return res(true, 200, 'Subforeman listed', $subforeman);


    }

    // For mandor bidang
    public function fill_spraying(Request $request) {
        /*
            {
                "spraying_id": "1",
                "expectation": "12",
                "subforeman_note": null,
                "begin": "13:30",
                "ended": "18:30",
                "hk_name": [
                    "diana",
                    "seredity"
                ],
                "image": {}
            }
        */
        $validator = Validator::make($request->all(), [
            'spraying_id' => 'required',
            'expectation' => 'required',
            'begin' => 'required',
            'ended' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors());

        $fillspraying = FillSpraying::where('spraying_id', $request->spraying_id)->first();
        if ($fillspraying->exists()) 
            return res(false, 404, 'Data for today existed');

        if ($request->hasFile('image')) {
            $request->validate([ 'image' => 'image:jpeg,png,jpg|max:2048'   ]);
            $image = $request->file('image');
            $image_folder = 'maintain/spraying';
            $image_name = Uuid::uuid4() . '.' . $image->getClientOriginalExtension();
            $image_url = Storage::disk('public')->put($image_folder, $request->file('image'));
            $image_url = asset('/storage/' . $image_url);
        } else {
            $image_url = null;
        }

        FillSpraying::create([
            'spraying_id' => $request->spraying_id,
            'expectation' => $request->expectation,
            'image' => $image_url,
            'subforeman_note' => $request->subforeman_note,
            'begin' => $request->begin,
            'ended' => $request->ended,
            'hk_name' => $request->hk_name
        ]);

        
        return res(true, 200, 'Spraying report filled successfully');
    }

    public function fill_fertilizer(Request $request) {
        $validator = Validator::make($request->all(), [
            'spraying_id' => 'required',
            'expectation' => 'required',
            'begin' => 'required',
            'ended' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors());

        $fillfertilizer = FillFertilizer::where('fertilizer_id', $request->fertilizer_id)->first();
        if ($fillfertilizer->exists()) 
            return res(false, 404, 'Data for today existed');

        if ($request->hasFile('image')) {
            $request->validate([ 'image' => 'image:jpeg,png,jpg|max:2048' ]);
            $image = $request->file('image');
            $image_folder = 'maintain/fertilizer';
            $image_name = Uuid::uuid4() . '.' . $image->getClientOriginalExtension();
            $image_url = Storage::disk('public')->put($image_folder, $request->file('image'));
            $image_url = asset('/storage/' . $image_url);
        } else {
            $image_url = null;
        }

        FillFertilizer::create([
            'fertilizer_id' => $request->fertilizer_id,
            'expectation' => $request->expectation,
            'image' => $image_url,
            'subforeman_note' => $request->subforeman_note,
            'begin' => $request->begin,
            'ended' => $request->ended,
            'hk_name' => $request->hk_name
        ]);

        
        return res(true, 200, 'fertilizer report filled successfully');
    }

    public function fill_pcontrol(Request $request) {
        $validator = Validator::make($request->all(), [
            'spraying_id' => 'required',
            'expectation' => 'required',
            'begin' => 'required',
            'ended' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors());

        $fillfertilizer = FillFertilizer::where('fertilizer_id', $request->fertilizer_id)->first();
        if ($fillfertilizer->exists()) 
            return res(false, 404, 'Data for today existed');

        if ($request->hasFile('image')) {
            $request->validate([ 'image' => 'image:jpeg,png,jpg|max:2048' ]);
            $image = $request->file('image');
            $image_folder = 'maintain/fertilizer';
            $image_name = Uuid::uuid4() . '.' . $image->getClientOriginalExtension();
            $image_url = Storage::disk('public')->put($image_folder, $request->file('image'));
            $image_url = asset('/storage/' . $image_url);
        } else {
            $image_url = null;
        }

        FillFertilizer::create([
            'fertilizer_id' => $request->fertilizer_id,
            'expectation' => $request->expectation,
            'image' => $image_url,
            'subforeman_note' => $request->subforeman_note,
            'begin' => $request->begin,
            'ended' => $request->ended,
            'hk_name' => $request->hk_name
        ]);

        
        return res(true, 200, 'fertilizer report filled successfully');
    }

}
