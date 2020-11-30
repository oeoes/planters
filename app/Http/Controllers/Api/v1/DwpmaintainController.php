<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\AfdellingReference;
use App\Models\BlockReference;
use App\Models\Foreman;
use App\Models\Maintain\CircleType;
use App\Models\Maintain\FertilizerType;
use App\Models\Maintain\FillCircle;
use App\Models\Maintain\FillFertilizer;
use App\Models\Maintain\FillGawangan;
use App\Models\Maintain\FillPcontrols;
use App\Models\Maintain\FillPruning;
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
            'ingredients_type' => 'required',
            'ingredients_amount' => 'required',
            'target_coverage' => 'required', 
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

        $hk = AfdellingReference::where('afdelling_id', fme()->afdelling_id)->where('available_date', date('Y-m-d'))->first();
        $current_hk = $hk->available_hk;
        $used_hk    = $request->hk_used;
        $limit_hk   = $current_hk - $used_hk;
        $hk->update(['available_hk' => $limit_hk]);

        $subforeman->increment('active');
        $subforeman->save();

        $data = [
            'block_ref_id' => (int) $request->block_ref_id,
            'foreman' => foreman($request->foreman_id)->name,
            'subforeman'=> subforeman($request->subforeman_id)->name,
            'date' => $request->date,
            'ingredients_type' => $request->ingredients_type,
            'ingredients_amount' => (float) $request->ingredients_amount,
            'target_coverage'  => (float) $request->target_coverage,
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
            'ingredients_type' => 'required',
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

        $hk = AfdellingReference::where('afdelling_id', fme()->afdelling_id)->where('available_date', date('Y-m-d'))->first();
        $current_hk = $hk->available_hk;
        $used_hk    = $request->hk_used;
        $limit_hk   = $current_hk - $used_hk;
        $hk->update(['available_hk' => $limit_hk]);

        $subforeman->increment('active');
        $subforeman->save();

        $data = [
            'block_ref_id' => (int) $request->block_ref_id,
            'foreman' => foreman($request->foreman_id)->name,
            'subforeman'=> subforeman($request->subforeman_id)->name,
            'date' => $request->date,
            'ingredients_type' => $request->ingredients_type,
            'ingredients_amount' => (float) $request->ingredients_amount,
            'target_coverage'  => (float) $request->target_coverage,
            'hk_used' => (float)$request->hk_used,
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
            'ingredients_type' => 'required',
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

        $hk = AfdellingReference::where('afdelling_id', fme()->afdelling_id)->where('available_date', date('Y-m-d'))->first();
        $current_hk = $hk->available_hk;
        $used_hk    = $request->hk_used;
        $limit_hk   = $current_hk - $used_hk;
        $hk->update(['available_hk' => $limit_hk]);

        $subforeman->increment('active');
        $subforeman->save();

        $data = [
            'block_ref_id' => (int) $request->block_ref_id,
            'foreman' => foreman($request->foreman_id)->name,
            'subforeman'=> subforeman($request->subforeman_id)->name,
            'date' => $request->date,
            'ingredients_type' => $request->ingredients_type,
            'ingredients_amount' => (float) $request->ingredients_amount,
            'target_coverage'  => (float) $request->target_coverage,
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
            'target_coverage' => 'required', 
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

        $hk = AfdellingReference::where('afdelling_id', fme()->afdelling_id)->where('available_date', date('Y-m-d'))->first();
        $current_hk = $hk->available_hk;
        $used_hk    = $request->hk_used;
        $limit_hk   = $current_hk - $used_hk;
        $hk->update(['available_hk' => $limit_hk]);

        $subforeman->increment('active');
        $subforeman->save();

        $data = [
            'block_ref_id' => (int) $request->block_ref_id,
            'foreman' => foreman($request->foreman_id)->name,
            'subforeman'=> subforeman($request->subforeman_id)->name,
            'date' => $request->date,
            'target_coverage'  => (float) $request->target,
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
            'target_coverage' => 'required', 
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
            'foreman' => foreman($request->foreman_id)->name,
            'subforeman'=> subforeman($request->subforeman_id)->name,
            'date' => $request->date,
            'target_coverage'  => (float) $request->target,
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
            'target_coverage' => 'required', 
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

        $hk = AfdellingReference::where('afdelling_id', fme()->afdelling_id)->where('available_date', date('Y-m-d'))->first();
        $current_hk = $hk->available_hk;
        $used_hk    = $request->hk_used;
        $limit_hk   = $current_hk - $used_hk;
        $hk->update(['available_hk' => $limit_hk]);

        $subforeman->increment('active');
        $subforeman->save();

        $data = [
            'block_ref_id' => (int) $request->block_ref_id,
            'foreman' => foreman($request->foreman_id)->name,
            'subforeman'=> subforeman($request->subforeman_id)->name,
            'date' => $request->date,
            'target_coverage'  => (float) $request->target_coverage,
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

        $validator = Validator::make($request->all(), [
            'spraying_id' => 'required',
            'ftarget_coverage' => 'required',
            'fingredients_amount' => 'required',
            'begin' => 'required',
            'ended' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors()->first());

        $fillspraying = FillSpraying::where('spraying_id', $request->spraying_id)->first();
        if ($fillspraying) 
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
            'ftarget_coverage' => $request->ftarget_coverage,
            'fingredients_amount' => $request->fingredients_amount,
            'image' => $image_url,
            'subforeman_note' => $request->subforeman_note,
            'begin' => $request->begin,
            'ended' => $request->ended,
            'hk_name' => $request->hk_name
        ]);

        $reference = SprayingType::find($request->spraying_id);
        $block_ref_id = $reference->block_ref_id;

        $tcov = BlockReference::find($block_ref_id);
        $current_coverage = $tcov->available_coverage;
        $used_coverage = $request->ftarget_coverage;
        $new_coverage = $current_coverage - $used_coverage;
        $tcov->update([ 'available_coverage' => $new_coverage ]);

        if ($tcov->available_coverage == 0) 
        $tcov->increment('completed'); 
        
        return res(true, 200, 'Spraying report filled successfully');
    }

    public function fill_fertilizer(Request $request) {
        $validator = Validator::make($request->all(), [
            'fertilizer_id' => 'required',
            'ftarget_coverage' => 'required',
            'fingredients_amount' => 'required',
            'begin' => 'required',
            'ended' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors()->first());

        $fillfertilizer = FillFertilizer::where('fertilizer_id', $request->fertilizer_id)->first();
        if ($fillfertilizer) 
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
            'ftarget_coverage' => $request->ftarget_coverage,
            'fingredients_amount' => $request->fingredients_amount,
            'image' => $image_url,
            'subforeman_note' => $request->subforeman_note,
            'begin' => $request->begin,
            'ended' => $request->ended,
            'hk_name' => $request->hk_name
        ]);


        $reference = FertilizerType::find($request->fertilizer_id);
        $block_ref_id = $reference->block_ref_id;

        $tcov = BlockReference::find($block_ref_id);
        $current_coverage = $tcov->available_coverage;
        $used_coverage = $request->expectation;
        $new_coverage = $current_coverage - $used_coverage;
        $tcov->update([ 'available_coverage' => $new_coverage ]);

        if ($tcov->available_coverage == 0) 
        $tcov->increment('completed'); 
        
        return res(true, 200, 'fertilizer report filled successfully');
    }

    public function fill_pcontrol(Request $request) {
        $validator = Validator::make($request->all(), [
            'pcontrol_id' => 'required',
            'ftarget_coverage' => 'required',
            'fingredients_amount' => 'required',
            'begin' => 'required',
            'ended' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors()->first());

        $fillpestcontrol = FillPcontrols::where('pcontrol_id', $request->pcontrol_id)->first();
        if ($fillpestcontrol) 
            return res(false, 404, 'Data for today existed');

        if ($request->hasFile('image')) {
            $request->validate([ 'image' => 'image:jpeg,png,jpg|max:2048' ]);
            $image = $request->file('image');
            $image_folder = 'maintain/pest_control';
            $image_name = Uuid::uuid4() . '.' . $image->getClientOriginalExtension();
            $image_url = Storage::disk('public')->put($image_folder, $request->file('image'));
            $image_url = asset('/storage/' . $image_url);
        } else {
            $image_url = null;
        }

        FillPcontrols::create([
            'pcontrol_id' => $request->pcontrol_id,
            'ftarget_coverage' => $request->ftarget_coverage,
            'fingredients_amount' => $request->fingredients_amount,
            'image' => $image_url,
            'subforeman_note' => $request->subforeman_note,
            'begin' => $request->begin,
            'ended' => $request->ended,
            'hk_name' => $request->hk_name
        ]);

        $reference = PestControl::find($request->pcontrol_id);
        $block_ref_id = $reference->block_ref_id;

        $tcov = BlockReference::find($block_ref_id);
        $current_coverage = $tcov->available_coverage;
        $used_coverage = $request->expectation;
        $new_coverage = $current_coverage - $used_coverage;
        $tcov->update([ 'available_coverage' => $new_coverage ]);

        if ($tcov->available_coverage == 0) 
        $tcov->increment('completed'); 
        
        return res(true, 200, 'fertilizer report filled successfully');
    }

    public function fill_circle(Request $request) {
        $validator = Validator::make($request->all(), [
            'circle_id' => 'required',
            'ftarget_coverage' => 'required',
            'fingredients_amount' => 'required',
            'begin' => 'required',
            'ended' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors()->first());

        $fillcircle = FillCircle::where('circle_id', $request->circle_id)->first();
        if ($fillcircle) 
            return res(false, 404, 'Data for today existed');

        if ($request->hasFile('image')) {
            $request->validate([ 'image' => 'image:jpeg,png,jpg|max:2048' ]);
            $image = $request->file('image');
            $image_folder = 'maintain/circle';
            $image_name = Uuid::uuid4() . '.' . $image->getClientOriginalExtension();
            $image_url = Storage::disk('public')->put($image_folder, $request->file('image'));
            $image_url = asset('/storage/' . $image_url);
        } else {
            $image_url = null;
        }

        FillCircle::create([
            'circle_id' => $request->circle_id,
            'ftarget_coverage' => $request->ftarget_coverage,
            'image' => $image_url,
            'subforeman_note' => $request->subforeman_note,
            'begin' => $request->begin,
            'ended' => $request->ended,
            'hk_name' => $request->hk_name
        ]);

        $reference = CircleType::find($request->circle_id);
        $block_ref_id = $reference->block_ref_id;

        $tcov = BlockReference::find($block_ref_id);
        $current_coverage = $tcov->available_coverage;
        $used_coverage = $request->expectation;
        $new_coverage = $current_coverage - $used_coverage;
        $tcov->update([ 'available_coverage' => $new_coverage ]);
        
        if ($tcov->available_coverage == 0) 
        $tcov->increment('completed'); 

        return res(true, 200, 'Manual circle report filled successfully');
    }

    public function fill_pruning(Request $request) {
        $validator = Validator::make($request->all(), [
            'pruning_id' => 'required',
            'ftarget_coverage' => 'required',
            'begin' => 'required',
            'ended' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors()->first());

        $fillpruning = FillPruning::where('pruning_id', $request->pruning_id)->first();
        if ($fillpruning) 
            return res(false, 404, 'Data for today existed');

        if ($request->hasFile('image')) {
            $request->validate([ 'image' => 'image:jpeg,png,jpg|max:2048' ]);
            $image = $request->file('image');
            $image_folder = 'maintain/pruning';
            $image_name = Uuid::uuid4() . '.' . $image->getClientOriginalExtension();
            $image_url = Storage::disk('public')->put($image_folder, $request->file('image'));
            $image_url = asset('/storage/' . $image_url);
        } else {
            $image_url = null;
        }

        FillPruning::create([
            'pruning_id' => $request->pruning_id,
            'ftarget_coverage' => $request->ftarget_coverage,
            'image' => $image_url,
            'subforeman_note' => $request->subforeman_note,
            'begin' => $request->begin,
            'ended' => $request->ended,
            'hk_name' => $request->hk_name
        ]);

        $reference = PruningType::find($request->pruning_id);
        $block_ref_id = $reference->block_ref_id;

        $tcov = BlockReference::find($block_ref_id);
        $current_coverage = $tcov->available_coverage;
        $used_coverage = $request->expectation;
        $new_coverage = $current_coverage - $used_coverage;
        $tcov->update([ 'available_coverage' => $new_coverage ]);

        if ($tcov->available_coverage == 0) 
        $tcov->increment('completed'); 
        
        return res(true, 200, 'Manual pruning report filled successfully');
    }

    public function fill_gawangan(Request $request) {
        $validator = Validator::make($request->all(), [
            'gawangan_id' => 'required',
            'ftarget_coverage' => 'required',
            'begin' => 'required',
            'ended' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors()->first());

        $fillgawangan = FillGawangan::where('gawangan_id', $request->gawangan_id)->first();
        if ($fillgawangan) 
            return res(false, 404, 'Data for today existed');

        if ($request->hasFile('image')) {
            $request->validate([ 'image' => 'image:jpeg,png,jpg|max:2048' ]);
            $image = $request->file('image');
            $image_folder = 'maintain/gawangan';
            $image_name = Uuid::uuid4() . '.' . $image->getClientOriginalExtension();
            $image_url = Storage::disk('public')->put($image_folder, $request->file('image'));
            $image_url = asset('/storage/' . $image_url);
        } else {
            $image_url = null;
        }

        FillGawangan::create([
            'gawangan_id' => $request->gawangan_id,
            'ftarget_coverage' => $request->ftarget_coverage,
            'image' => $image_url,
            'subforeman_note' => $request->subforeman_note,
            'begin' => $request->begin,
            'ended' => $request->ended,
            'hk_name' => $request->hk_name
        ]);

        $reference = GawanganType::find($request->gawangan_id);
        $block_ref_id = $reference->block_ref_id;

        $tcov = BlockReference::find($block_ref_id);
        $current_coverage = $tcov->available_coverage;
        $used_coverage = $request->expectation;
        $new_coverage = $current_coverage - $used_coverage;
        $tcov->update([ 'available_coverage' => $new_coverage ]);

        if ($tcov->available_coverage == 0) 
        $tcov->increment('completed'); 

        return res(true, 200, 'Manual gawangan report filled successfully');
    }

    public function years() {
        $block_reference = BlockReference::where('foreman_id', fme()->id)
                        ->where('completed', 1)->orderBy('created_at', 'DESC')->get();
        $pyears = [];
        foreach ($block_reference as $key => $value) {
            $pyears [] = [
                'planting_year' => $value['planting_year']
            ];
        }
        return res(true, 200, 'Year listed!', $pyears);
    }

    public function block($year) {
        $block_reference = BlockReference::where('foreman_id', fme()->id)->where('planting_year', $year)
            ->where('completed', 1)->orderBy('created_at', 'DESC')->get();
        $blocks = [];
        foreach ($block_reference as $key => $value) {
            $blocks [] = [
                'block_id' => $value['block_id'],
                'block_code' => block($value['block_id']),
                'selected_year' => $year
            ];
        }
        return res(true, 200, 'Blocks listed!', $blocks);
    }

    public function date($year, $block_id) {
        $block_reference = BlockReference::where('foreman_id', fme()->id)->where('planting_year', $year)->where('block_id', $block_id)->where('completed', 1)->orderBy('created_at', 'DESC')->get();
        foreach ($block_reference as $key => $value) {
            $id = $value['id'];
            $jobtype_id = $value['id'];
            switch ($jobtype_id) {
                case 1:
                    $data = SprayingType::where('block_ref_id', $id)->orderByDesc('created_at')->get();
                    if(! $data) {
                        return res(true, 200, 'There no history');
                    } else {
                        $ids = [];
                        foreach ($data as $key => $value) {
                            $id = $value['id'];
                            $ids[] = [ $id ];
                        }
                        $fill = FillSpraying::whereIn('id', $ids)->get();
                        return res(true, 200, 'Date listed', $fill);
                    }
                break;
                
                case 2:
                    $data = FertilizerType::where('block_ref_id', $id)->orderByDesc('created_at')->get();
                    if(! $data) {
                        return res(true, 200, 'There no history');
                    } else {
                        $ids = [];
                        foreach ($data as $key => $value) {
                            $id = $value['id'];
                            $ids[] = [ $id ];
                        }
                        $fill = FillFertilizer::whereIn('id', $ids)->get();
                        return res(true, 200, 'Date listed', $fill);
                    }
                break;

                case 3:
                    $data = CircleType::where('block_ref_id', $id)->orderByDesc('created_at')->get();
                    if(! $data) {
                        return res(true, 200, 'There no history');
                    } else {
                        $ids = [];
                        foreach ($data as $key => $value) {
                            $id = $value['id'];
                            $ids[] = [ $id ];
                        }
                        $fill = FillCircle::whereIn('id', $ids)->get();
                        return res(true, 200, 'Date listed', $fill);
                    }
                break;

                case 4:
                    $data = PruningType::where('block_ref_id', $id)->orderByDesc('created_at')->get();
                    if(! $data) {
                        return res(true, 200, 'There no history');
                    } else {
                        $ids = [];
                        foreach ($data as $key => $value) {
                            $id = $value['id'];
                            $ids[] = [ $id ];
                        }
                        $fill = FillPruning::whereIn('id', $ids)->get();
                        return res(true, 200, 'Date listed', $fill);
                    }
                break;

                case 5:
                    $data = GawanganType::where('block_ref_id', $id)->orderByDesc('created_at')->get();
                    if(! $data) {
                        return res(true, 200, 'There no history');
                    } else {
                        $ids = [];
                        foreach ($data as $key => $value) {
                            $id = $value['id'];
                            $ids[] = [ $id ];
                        }
                        $fill = FillGawangan::whereIn('id', $ids)->get();
                        return res(true, 200, 'Date listed', $fill);
                    }
                break;

                case 6:
                    $data = PestControl::where('block_ref_id', $id)->orderByDesc('created_at')->get();
                    if(! $data) {
                        return res(true, 200, 'There no history');
                    } else {
                        $ids = [];
                        foreach ($data as $key => $value) {
                            $id = $value['id'];
                            $ids[] = [ $id ];
                        }
                        $fill = FillPcontrols::whereIn('id', $ids)->get();
                        return res(true, 200, 'Date listed', $fill);
                    }
                break;
            }
        }    
    }

    public function check_job_today() {
        // date
        // mandor 1
        // blok
        // hk used
        // target luas
        // jenis pupuk
        // target berat
        // catata
        $now = date('Y-m-d');
        $sfmid = sfme()->id;
        $joblists = [
            SprayingType::where('date', $now)->where('subforeman_id', $sfmid)->where('completed', 0)->first(),
            FertilizerType::where('date', $now)->where('subforeman_id', $sfmid)->where('completed', 0)->first(),
            CircleType::where('date', $now)->where('subforeman_id', $sfmid)->where('completed', 0)->first(),
            PruningType::where('date', $now)->where('subforeman_id', $sfmid)->where('completed', 0)->first(),
            GawanganType::where('date', $now)->where('subforeman_id', $sfmid)->where('completed', 0)->first(),
            PestControl::where('date', $now)->where('subforeman_id', $sfmid)->where('completed', 0)->first(),
        ];

        $data = '';
        $job_type = '';
        for ($i = 0; $i < count($joblists) ; $i++) { 
            if ($joblists[$i]) {
                $data = $joblists[$i];
                $job_type = self::get_job_type($i);
                break;
            }
        }
        if ($data == '') {
            return res(false, 404, 'There is no job today');
        }
        
        $blockref = BlockReference::where('id', $data->block_ref_id)->first();
        $block = block($blockref->block_id);
        if (! $data->ingredients_type) {
            $ingredients_type = null;
            $ingredientes_amount = null;
        } else {
            $ingredients_type = $data->ingredients_type;
            $ingredientes_amount = $data->ingredients_amount;
        }
        $dataArr = [
            'date' => $data->date,
            'job_type' => $job_type,
            'job_type_id' => $data->id,
            // 'foreman' => foreman($data->foreman_id),
            'foreman' => Foreman::find($data->foreman_id)->select('name'),
            'block' => $block,
            'hk_used' => $data->hk_used,
            'target_coverage' => $data->target_coverage,
            'ingredients_type' => $ingredients_type,
            'ingredients_amount' => $ingredientes_amount,
            'foreman_note' => $data->foreman_note
        ];

        return res(true, 200, 'Job today', $dataArr);
    }

    public static function get_job_type($index) {
        switch($index) {
            case 0:
                return 'spraying';
            break;

            case 1:
                return 'fertilizer';
            break;

            case 2:
                return 'circle';
            break;

            case 3:
                return 'prunning';
            break;

            case 4:
                return 'gawangan';
            break;

            case 5:
                return 'pest_control';
            break;
        }
    }

}
