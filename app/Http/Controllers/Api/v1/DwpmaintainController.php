<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\AfdellingReference;
use App\Models\BlockReference;
use App\Models\Foreman;
use App\Models\Harvesting\FillHarvesting;
use App\Models\Harvesting\HarvestingType;
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
        
        $request['afdelling_id'] = fme()->afdelling_id;

        SprayingType::create($request->all());

        $subforeman->increment('active');
        $subforeman->save();

        return res(true, 200, 'Daily work plan spraying added');
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

        $request['afdelling_id'] = fme()->afdelling_id;
        FertilizerType::create($request->all());

        $subforeman->increment('active');
        $subforeman->save();

        return res(true, 200, 'Daily work plan fertilizer added');
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

        $request['afdelling_id'] = fme()->afdelling_id;
        PestControl::create($request->all());

        $subforeman->increment('active');
        $subforeman->save();

        return res(true, 200, 'Daily work plan pest control added');
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

        $request['afdelling_id'] = fme()->afdelling_id;
        CircleType::create($request->all());

        $subforeman->increment('active');
        $subforeman->save();

        return res(true, 200, 'Daily work plan manual circle added');

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

        $request['afdelling_id'] = fme()->afdelling_id;
        PruningType::create($request->all());

        $subforeman->increment('active');
        $subforeman->save();

        return res(true, 200, 'Daily work plan pruning added');
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


        $request['afdelling_id'] = fme()->afdelling_id;
        GawanganType::create($request->all());

        $subforeman->increment('active');
        $subforeman->save();

        return res(true, 200, 'Daily work plan pruning added');
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

        $request['afdelling_id'] = sfme()->afdelling_id;
        FillSpraying::create($request->all());

        $reference = SprayingType::find($request->spraying_id);
        $block_ref_id = $reference->block_ref_id;

        $tcov = BlockReference::find($block_ref_id);
        $current_coverage = $tcov->available_coverage;
        $used_coverage = $request->ftarget_coverage;
        $new_coverage = $current_coverage - $used_coverage;
        $tcov->update([ 'available_coverage' => $new_coverage ]);
        
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

        $request['afdelling_id'] = sfme()->afdelling_id;
        FillFertilizer::create($request->all());

        $reference = FertilizerType::find($request->fertilizer_id);
        $block_ref_id = $reference->block_ref_id;

        $tcov = BlockReference::find($block_ref_id);
        $current_coverage = $tcov->available_coverage;
        $used_coverage = $request->expectation;
        $new_coverage = $current_coverage - $used_coverage;
        $tcov->update([ 'available_coverage' => $new_coverage ]);
        
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

        $request['afdelling_id'] = sfme()->afdelling_id;
        FillPcontrols::create($request->all());

        $reference = PestControl::find($request->pcontrol_id);
        $block_ref_id = $reference->block_ref_id;

        $tcov = BlockReference::find($block_ref_id);
        $current_coverage = $tcov->available_coverage;
        $used_coverage = $request->expectation;
        $new_coverage = $current_coverage - $used_coverage;
        $tcov->update([ 'available_coverage' => $new_coverage ]);
        
        return res(true, 200, 'fertilizer report filled successfully');
    }

    public function fill_circle(Request $request) {
        $validator = Validator::make($request->all(), [
            'circle_id' => 'required',
            'ftarget_coverage' => 'required',
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

        $request['afdelling_id'] = sfme()->afdelling_id;
        FillCircle::create($request->all());

        $reference = CircleType::find($request->circle_id);
        $block_ref_id = $reference->block_ref_id;

        $tcov = BlockReference::find($block_ref_id);
        $current_coverage = $tcov->available_coverage;
        $used_coverage = $request->expectation;
        $new_coverage = $current_coverage - $used_coverage;
        $tcov->update([ 'available_coverage' => $new_coverage ]);
    

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

        $request['afdelling_id'] = sfme()->afdelling_id;
        FillPruning::create($request->all());

        $reference = PruningType::find($request->pruning_id);
        $block_ref_id = $reference->block_ref_id;

        $tcov = BlockReference::find($block_ref_id);
        $current_coverage = $tcov->available_coverage;
        $used_coverage = $request->expectation;
        $new_coverage = $current_coverage - $used_coverage;
        $tcov->update([ 'available_coverage' => $new_coverage ]);
        
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

        $request['afdelling_id'] = sfme()->afdelling_id;
        FillGawangan::create($request->all());

        $reference = GawanganType::find($request->gawangan_id);
        $block_ref_id = $reference->block_ref_id;

        $tcov = BlockReference::find($block_ref_id);
        $current_coverage = $tcov->available_coverage;
        $used_coverage = $request->expectation;
        $new_coverage = $current_coverage - $used_coverage;
        $tcov->update([ 'available_coverage' => $new_coverage ]);

        return res(true, 200, 'Manual gawangan report filled successfully');
    }

    public function years() {
        $block_reference = BlockReference::where('foreman_id', fme()->id)
                        ->where('completed', 1)
                        ->distinct('planting_year')
                        ->select('planting_year')
                        ->get();
        $block_reference = collect($block_reference)->sortBy('planting_year')->reverse()->toArray();
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

    public function dates($year, $block_id) {
        // pasti gada yg sama [first] bukan get
        $reference = BlockReference::where('planting_year', $year)
                                    ->where('block_id', $block_id)
                                    ->where('completed', 1)->first();
        if (! $reference) {
            return res(false, 404, 'Cannot find the completed daily work plan');
        }
        $dates = $reference->model::where('block_ref_id', $reference->id)->orderBy('date', 'DESC')->get();
        $arrDates = [];
        foreach ($dates as $key => $value) {
            $arrDates [] =[
                'block_reference_id' => $reference->id,
                'date' => $value['date'],
                'foreman_id' => fme()->id,
            ];
        }
        return res(true, 200, 'Date listed', $arrDates);
    }

    public function detail_rkh_completed($block_ref_id, $date) {
        $single_ref = BlockReference::find($block_ref_id);
        $data = $single_ref->model::where('block_ref_id', $block_ref_id)->where('date', $date)->first();

            if (in_array($single_ref->jobtype_id, [1, 2, 6])) {
                $ingredients_amount = $data->ingredients_amount;
                $ingredients_type = $data->ingredients_type;
                $akp = null;
                $bjr = null;
            } else if (in_array($single_ref->jobtype_id, [3, 4, 5])) {
                $ingredients_amount = null;
                $ingredients_type = null;
                $akp = null;
                $bjr = null;
            } else if (in_array($single_ref->jobtype_id, [7])) {
                $ingredients_amount = null;
                $ingredients_type = null;
                $akp = $data->akp;
                $bjr = $data->bjr;
            }

            $foreman = [
                'date' => date('Y-m-d', strtotime($data->date)),
                'subforeman' => subforeman($data->subforeman_id)->name,
                'block_code' => block($single_ref->block_id),
                'job_type'   => $single_ref->jobtype_id,
                'target_coverage'    => $data->target_coverage,
                'akp' => $akp,
                'bjr' => $bjr,
                'ingredients_type'   => $ingredients_type,
                'ingredients_amount' => $ingredients_amount,
                'foreman_note' => $data->foreman_note,
                'hk_used'   => $data->hk_used,
                'completed' => 0,
            ];

            switch ($single_ref->jobtype_id) {
                case 1:
                    $fillout = $single_ref->fill::where('spraying_id', $data->id)->first();
                    break;
                case 2:
                    $fillout = $single_ref->fill::where('fertilizer_id', $data->id)->first();
                    break;
                case 3:
                    $fillout = $single_ref->fill::where('circle_id', $data->id)->first();
                    break;
                case 4:
                    $fillout = $single_ref->fill::where('pruning_id', $data->id)->first();
                    break;
                case 5:
                    $fillout = $single_ref->fill::where('gawangan_id', $data->id)->first();
                    break;
                case 6:
                    $fillout = $single_ref->fill::where('pcontrol_id', $data->id)->first();
                    break;
                case 7:
                    $fillout = $single_ref->fill::where('harvest_id', $data->id)->first();
                    break;
            }

            if (! $fillout) {
                $subforeman = null;
            } else {

                if (in_array($single_ref->jobtype_id, [1, 2, 6])) {
                    $ingredients_amount = $fillout->fingredients_amount;
                    $ingredients_type = $fillout->fingredients_type;
                    $akp = null;
                    $bjr = null;
                } else if (in_array($single_ref->jobtype_id, [3, 4, 5])) {
                    // circle, pruning, gawangan
                    $ingredients_amount = null;
                    $ingredients_type = null;
                    $akp = null;
                    $bjr = null;
                } else if (in_array($single_ref->jobtype_id, [7])) {
                    $ingredients_amount = null;
                    $ingredients_type = null;
                    $akp = $fillout->akp;
                    $bjr = $fillout->bjr;
                }

                $subforeman = [
                    "begin" => $fillout->begin,
                    "ended" => $fillout->ended,
                    "target_coverage" => $fillout->ftarget_coverage,
                    'bjr' => $bjr,
                    'ingredients_type'   => $ingredients_type,
                    'ingredients_amount' => $ingredients_amount,
                    "image" => $fillout->image,
                    "subforeman_note" => $fillout->subforeman_note,
                    "hk_name" => $fillout->hk_name,
                    "completed" => $fillout->completed
                ];
            }

            $data = [
                "foreman" => $foreman,
                "subforeman" => $subforeman
            ];
            
            return res(true, 200, 'Detail RKH', $data); 
    }

    public function check_job_today($subforeman_id) {
        $joblists = [
            SprayingType::where('subforeman_id', $subforeman_id)->where('completed', 0)->first(),
            FertilizerType::where('subforeman_id', $subforeman_id)->where('completed', 0)->first(),
            CircleType::where('subforeman_id', $subforeman_id)->where('completed', 0)->first(),
            PruningType::where('subforeman_id', $subforeman_id)->where('completed', 0)->first(),
            GawanganType::where('subforeman_id', $subforeman_id)->where('completed', 0)->first(),
            PestControl::where('subforeman_id', $subforeman_id)->where('completed', 0)->first(),
            HarvestingType::where('subforeman_id', $subforeman_id)->where('completed', 0)->first(),
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
            return res(false, 404, 'There is no job');
        }
        
        $blockref = BlockReference::where('id', $data->block_ref_id)->first();
        $block = block($blockref->block_id);

        if (in_array($blockref->jobtype_id, [1, 2, 6])) {
            $ingredients_amount = $data->ingredients_amount;
            $ingredients_type   = $data->ingredients_type;
            $bjr = null;
        } else if (in_array($blockref->jobtype_id, [3, 4, 5])) {
            $ingredients_amount = null;
            $ingredients_type = null;
            $bjr = null;
        } else if (in_array($blockref->jobtype_id, [7])) {
            $ingredients_amount = null;
            $ingredients_type = null;
            $bjr = $data->bjr;
            $akp = $data->akp;
            $taksasi = $data->taksasi;
        }

        
        $subforeman = [
            'date' => $data->date,
            'job_type_id' => $data->id,
            'foreman' => Foreman::where('id', $data->foreman_id)->select('name', 'email')->first(),
            'block_code' => $block,
            'hk_used' => $data->hk_used,
            'target_coverage' => $data->target_coverage,
            'bjr' => $bjr,
            'akp' => !$data->akp ? $data->akp : null,
            'taksasi' => !$data->taksasi ? $data->taksasi : null,
            'ingredients_type' => $ingredients_type,
            'ingredients_amount' => $ingredients_amount,
            'foreman_note' => $data->foreman_note
        ];

        return res(true, 200, 'Job today', $subforeman);
    }

    public function set_complete_rkh($block_ref_id) {
        $ref = BlockReference::where('id', $block_ref_id)->first();
        if (! $ref) {
            return res(false, 404, 'Block reference not found');
        }

        $data = $ref->model::where('block_ref_id', $block_ref_id)->where('completed', 0)->first();
        if ($data) {
            $data->update(['completed' => 1]);

            $subforeman = Subforeman::where('id', $data->subforeman_id)->first();
            $subforeman->update(['active' => 0]);

            if ($ref->available_coverage == 0) {
                $ref->increment('completed');
                    return res(true, 200, 'Block spreading completed, view this block on history menu');
            }
            return res(true, 200, 'Daily work plan completed');
        } else {
            return res(false, 404, 'Daily work plan not found');
        }
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
