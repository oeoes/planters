<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Afdelling;
use App\Models\Block;
use App\Models\BlockReference;
use App\Models\Company;
use App\Models\Farm;
use App\Models\Harvesting\EmployeeHarvesting;
use App\Models\Harvesting\FillHarvesting;
use App\Models\Harvesting\HarvestingType;
use App\Models\Maintain\SprayingType;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('superadmin.dashboard.index')->with(['companies' => $companies]);
    }

    public function farms($company_id)
    {
        return response()->json([
            'status' => true,
            'message' => 'List of farms',
            'data' => Farm::where('company_id', $company_id)->get()
        ]);
    }

    public function afdellings($farm_id)
    {
        return response()->json([
            'status' => true,
            'message' => 'List of afdellings',
            'data' => Afdelling::where('farm_id', $farm_id)->get()
        ]);
    }

    // public function blocks($company, $farm, $afdelling, $year)
    public function filter(Request $request)
    {
        $info = DB::table('companies')
            ->join('farms', 'farms.company_id', '=', 'companies.id')
            ->join('afdellings', 'farms.id', '=', 'afdellings.farm_id')
            ->where('companies.id', $request->company)
            ->select('companies.company_name', 'farms.name as farm', 'afdellings.name as afdelling')
            ->first();

        $agency = DB::table('companies')
            ->join('farms', 'farms.company_id', '=', 'companies.id')
            ->join('agencies', 'companies.id', '=', 'agencies.company_id')
            ->groupBy('companies.id', 'agencies.name')
            ->select('companies.id', 'agencies.name', DB::raw('count(*) as total'))
            ->where('companies.id', $request->company)
            ->get();

        $manager = DB::table('farms')
            ->join('afdellings', 'afdellings.farm_id', '=', 'farms.id')
            ->join('farm_managers', 'farms.id', '=', 'farm_managers.farm_id')
            ->groupBy('farms.id', 'farm_managers.name')
            ->select('farms.id', 'farm_managers.name', DB::raw('count(*) as total'))
            ->where('farms.id', $request->farm)
            ->get();

        $assistant = DB::table('afdellings')
            ->join('blocks', 'blocks.afdelling_id', '=', 'afdellings.id')
            ->join('assistants', 'afdellings.id', '=', 'assistants.afdelling_id')
            ->groupBy('afdellings.id', 'assistants.name')
            ->select('afdellings.id', 'assistants.name', DB::raw('count(*) as total'))
            ->where('afdellings.id', $request->afdelling)
            ->get();

        $foreman = DB::table('foremans')
            ->where('afdelling_id', $request->afdelling)
            ->get()->count();

        $subforeman = DB::table('subforemans')
            ->where('afdelling_id', $request->afdelling)
            ->get()->count();

        return response()->json([
            'status' => true,
            'message' => 'Results',
            'data' => [
                'general' => $info,
                'agency' => $agency,
                'manager' => $manager,
                'assistant' => $assistant,
                'foreman' => $foreman,
                'subforeman' => $subforeman,
                'job_completeness' => [
                    'spraying' => self::job_completeness(1, $request->year, $request->afdelling),
                    'fertilizer' => self::job_completeness(2, $request->year, $request->afdelling),
                    'circle' => self::job_completeness(3, $request->year, $request->afdelling),
                    'pruning' => self::job_completeness(4, $request->year, $request->afdelling),
                    'gawangan' => self::job_completeness(5, $request->year, $request->afdelling),
                    'pcontrol' => self::job_completeness(6, $request->year, $request->afdelling),
                ],
                'harvest' => [
                    'harvesting' => self::job_completeness(7, $request->year, $request->afdelling),
                    'detail' => self::harvest($request->year, $request->afdelling),
                ],
                'panen' => $this->loadpanen($request->company, $request->year),
                'panen_afdelling' => self::harvest_each_afdelling($request->farm, $request->year),
                'job_completeness_each_block' => self::job_completeness_each_block($request->afdelling, $request->year),
            ]
        ]);
    }

    public function filter_completeness_block (Request $request) {
        return response()->json([
            'status' => true,
            'message' => 'Results',
            'data' => [
                'job_completeness_each_block' => self::job_completeness_each_block($request->afdelling, $request->year, $request->jobtype),
            ]
        ]);
    }

    public function filter_trend (Request $request) {
        return response()->json([
            'status' => true,
            'message' => 'Results',
            'data' => [
                'activities' => [
                    'data1' => self::trend_activities($request->jobtype1, $request->afdelling, $request->year),
                    'data2' => self::trend_activities($request->jobtype2, $request->afdelling, $request->year)
                ]
            ]
        ]);
    }

    public static function trend_activities ($jobtype, $afdelling, $year) {
        $block_id = [];
        $blocks = Block::where('afdelling_id', $afdelling)->get();
        foreach ($blocks as $value) {
            // untuk mengambil semua block berdasarkan company
            $block_id[] = $value->id;
        }

        $count_activities = [];
        for ($i = 1; $i <= 12; $i++) {
            $blockrefs = BlockReference::whereMonth('created_at', $i)->whereYear('created_at', date('Y'))
                ->whereIn('block_id', $block_id)->where(['completed' => 1, 'planting_year' => $year, 'jobtype_id' => $jobtype])->get();
            
            $count_activities[] = count($blockrefs);
        }

        return $count_activities;
    }

    public static function job_completeness($jobtype, $year, $afdelling)
    {
        $results = 0;

        $block_id = [];
        $blocks = Block::where('afdelling_id', $afdelling)->get();
        foreach ($blocks as $value) {
            // untuk mengambil semua block berdasarkan company
            $block_id[] = $value->id;
        }
        $blockrefs = BlockReference::whereIn('block_id', $block_id)->where(['jobtype_id' => $jobtype, 'planting_year' => $year])->get();

        foreach ($blockrefs as $ref) {
            $model = $ref->model::where('block_ref_id', $ref->id)->select('id', 'target_coverage')->first();
            if ($model) {
                $fill = $ref->fill::where($ref->fill_id, $model->id)->select('ftarget_coverage')->first();
                if ($fill) {
                    $results += $model->target_coverage * 100 / $fill->ftarget_coverage;
                }
            }
        }
        return $results;
    }

    public static function harvest($year, $afdelling)
    {
        $blockref = DB::table('block_static_references')
            ->join('block_references', 'block_static_references.id', '=', 'block_references.block_static_reference_id')
            ->select('block_references.id', 'block_references.fill_id', 'block_references.model', 'block_references.fill')
            ->where(['block_references.jobtype_id' => 7, 'block_static_references.planting_year' => $year])
            ->first();

        $avg_time = 0;
        $total_kg = 0;
        $hk_work = 0;
        if ($blockref) {
            $target = $blockref->model::where('block_ref_id', $blockref->id)->select('id', 'target_coverage')->get();
            foreach ($target as $tar) {
                $result = $blockref->fill::where([$blockref->fill_id => $tar->id, 'afdelling_id' => $afdelling])->select('final_harvesting', 'begin', 'ended')->first();
                $employees = EmployeeHarvesting::where('harvest_id', $tar->id)->get()->count();
                if ($result) {
                    $start = explode(':', $result->begin);
                    $end = explode(':', $result->ended);

                    $start = Carbon::create(0,0,0,$start[0],$start[1],$start[2]);
                    $end = Carbon::create(0, 0, 0,$end[0], $end[1], $end[2]);
                    
                    $avg_time += $start->diffInHours($end) / count($target);
                    $total_kg += $result->final_harvesting;

                    $hk_work += $employees;
                }
            }
        }
        return [$avg_time, $total_kg, $hk_work];
    }

    /**
     * 
     */
    public static function job_completeness_each_block ($afdelling, $year, $jobtype=1) {
        $block_list = [];
        $block_target = [];
        $block_result = [];

        $blocks = Block::where('afdelling_id', $afdelling)->get();
        foreach ($blocks as $block) {
            $blockrefs = BlockReference::where(['block_id' => $block->id, 'planting_year' => $year, 'jobtype_id' => $jobtype])->get();
            $model_val = 0;
            $fill_val = 0;
            foreach ($blockrefs as $br) {
                $model = $br->model::where('block_ref_id', $br->id)->first();
                if ($model) {
                    $fill = $br->fill::where($br->fill_id, $model->id)->first();
                    if ($fill) {
                        $model_val += $model->target_coverage;
                        $fill_val += $fill->ftarget_coverage;
                    }
                }
            }
            $block_list[] = $block->code;
            $block_target[] = $model_val;
            $block_result[] = $fill_val;
        }

        return [$block_list, $block_target, $block_result];
    }

    public static function harvest_each_afdelling ($farm, $year) {
        $harvesting_result = [];
        $afdelling_name = [];
        $afdellings = Afdelling::where('farm_id', $farm)->get();
        foreach ($afdellings as $afdelling) {
            $afdelling_name[] = $afdelling->name;

            $blocks = Block::where('afdelling_id', $afdelling->id)->get();
            $harvesting_val = 0;
            foreach ($blocks as $block) {
                $blockrefs = BlockReference::where(['block_id' => $block->id, 'planting_year' => $year])->get();
                foreach ($blockrefs as $br) {
                    $harvesting = HarvestingType::where('block_ref_id', $br->id)->first();
                    if ($harvesting) {
                        $fill_harvesting = FillHarvesting::where('harvest_id', $harvesting->id)->first();
                        $harvesting_val += $fill_harvesting->final_harvesting;
                    }
                }
            }
            $harvesting_result[] = $harvesting_val;
        }

        return [$afdelling_name, $harvesting_result];
    }

    public function loadpanen($company, $year)
    {
        $farms = Farm::where('company_id', $company)->get();
        $block_id = [];
        foreach ($farms as $key => $farm) {
            $afdellings = Afdelling::where('farm_id', $farm->id)->get();
            foreach ($afdellings as $afdelling) {
                $blocks = Block::where('afdelling_id', $afdelling->id)->get();
                foreach ($blocks as $key => $value) {
                    // untuk mengambil semua block berdasarkan company
                    $block_id[] = $value->id;
                }
            }
        }
        $harvesting_result = [];
        $taksasi_result = [];
        for ($i = 0; $i < 12; $i++) {
            $blockrefs = BlockReference::whereMonth('created_at', $i + 1)->whereYear('created_at', date('Y'))
                ->whereIn('block_id', $block_id)->where(['completed' => 1, 'planting_year' => $year])->get();

            // total taksasi per bulan
            $taksasi_val = 0;
            // total panen perbulan
            $harvesting_val = 0;
            foreach ($blockrefs as $key => $ref) {

                // untuk ambil taksasi dari tabel harvesting
                $harvesting = HarvestingType::where('block_ref_id', $ref->id)->first();
                $taksasi_val += $harvesting->taksasi;

                // karena 1 harvestin  = 1 fill harvesting, fill harvesting gamungkin 2.
                $total_harvesting = FillHarvesting::where('harvest_id', $harvesting->id)->first();
                $harvesting_val += $total_harvesting->final_harvesting;
            }

            $taksasi_result[] = (int) $taksasi_val;
            $harvesting_result[] = (int) $harvesting_val;
        }

        return [$taksasi_result, $harvesting_result];
    }
}
