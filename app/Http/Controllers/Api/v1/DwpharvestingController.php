<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\AfdellingReference;
use App\Models\BlockReference;
use App\Models\Foreman;
use App\Models\Harvesting\EmployeeHarvesting;
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

class DwpharvestingController extends Controller
{
    public function store_harvest(Request $request) {
        $validator = Validator::make($request->all(), [
            'block_ref_id' => 'required',
            'foreman_id' => 'required',
            'subforeman_id' => 'required',
            'date' => 'required',
            'target_coverage' => 'required', 
            'akp' => 'required', 
            'bjr' => 'required', 
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

        if ($blockrefs->jobtype_id != 7 || $subforeman->jobtype_id != 7) 
            return res(false, 404, 'Wrong job type for block', [$blockrefs->jobtype_id, $subforeman->jobtype_id]);

        $harvesting = HarvestingType::where('block_ref_id', $request->block_ref_id)->where('foreman_id', $request->foreman_id)->latest()->first();
        if ($harvesting) {
            // if harvesting created less 1
            if ($harvesting->date == $request->date || $harvesting->completed == 0)
                return res(false, 404, 'Cannot do next, please fill this form first!');
        }

        HarvestingType::create($request->all());

        $subforeman->increment('active');
        $subforeman->save();

        return res(true, 200, 'Daily work plan harvesting added');
    }

    public function fill_harvesting(Request $request) {

        $validator = Validator::make($request->all(), [
            'harvest_id' => 'required',
            'ftarget_coverage' => 'required',
            'bjr' => 'required',
            'begin' => 'required',
            'ended' => 'required',
        ]);

        if ($validator->fails())
            return res(false, 404, $validator->errors()->first());

        $fillspraying = FillHarvesting::where('harvest_id', $request->harvest_id)->first();
        if ($fillspraying) 
            return res(false, 404, 'Data for today existed');

        if ($request->hasFile('image')) {
            $request->validate([ 'image' => 'image:jpeg,png,jpg|max:2048'   ]);
            $image = $request->file('image');
            $image_folder = 'harvesting';
            $image_name = Uuid::uuid4() . '.' . $image->getClientOriginalExtension();
            $image_url = Storage::disk('public')->put($image_folder, $request->file('image'));
            $image_url = asset('/storage/' . $image_url);
        } else {
            $image_url = null;
        }

        $employees = json_decode($request->hk_listed);
        // return $employees;
        $total_harvesting = 0;
        foreach ($employees as $key => $value) {
            EmployeeHarvesting::create([
                'harvest_id' => $request->harvest_id,
                'name' => $value->name,
                'total_harvesting' => $value->total_harvesting,
            ]);
            $total_harvesting += $value->total_harvesting;
        }
        
        FillHarvesting::create([
            'harvest_id' => $request->harvest_id,
            'ftarget_coverage' => $request->ftarget_coverage,
            'bjr' => $request->bjr,
            'total_harvesting' => $total_harvesting,
            'final_harvesting' => (float) $request->bjr * $total_harvesting,
            'image' => $image_url,
            'subforeman_note' => $request->subforeman_note,
            'begin' => $request->begin,
            'ended' => $request->ended,
        ]);

        $reference = HarvestingType::find($request->harvest_id);
        $block_ref_id = $reference->block_ref_id;

        $tcov = BlockReference::find($block_ref_id);
        $current_coverage = $tcov->available_coverage;
        $used_coverage = $request->ftarget_coverage;
        $new_coverage = $current_coverage - $used_coverage;
        $tcov->update([ 'available_coverage' => $new_coverage ]);

        if ($tcov->available_coverage == 0) 
        $tcov->increment('completed'); 
        
        return res(true, 200, 'Harvesting report filled successfully');
    }

}
