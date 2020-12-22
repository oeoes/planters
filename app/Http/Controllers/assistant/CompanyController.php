<?php

namespace App\Http\Controllers\assistant;

use App\Http\Controllers\Controller;
use App\Models\Afdelling;
use App\Models\Block;
use App\Models\Company;
use App\Models\Farm;
use App\Models\Harvesting\HarvestingType;
use App\Models\JobType;
use App\Models\Maintain\CircleType;
use App\Models\Maintain\FertilizerType;
use App\Models\Maintain\GawanganType;
use App\Models\Maintain\PestControl;
use App\Models\Maintain\PruningType;
use App\Models\Maintain\SprayingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function blocks()
    {
        $afdelling = Afdelling::find(auth()->guard('assistant')->user()->afdelling_id);
        $farm = Farm::find($afdelling->farm_id);
        $company = Company::find($farm->company_id);
        $assistant = Afdelling::find($afdelling->id)->assistant;
        $blocks = Block::where('afdelling_id', $afdelling->id)->get();
        $foremans = $afdelling->foreman;
        $jobtypes = JobType::all();

        $sprayings = self::get_subforeman($afdelling->id)->where('job_types.id', 1)->get();
        $fertilizers = self::get_subforeman($afdelling->id)->where('job_types.id', 2)->get();
        $circles = self::get_subforeman($afdelling->id)->where('job_types.id', 3)->get();
        $prunings = self::get_subforeman($afdelling->id)->where('job_types.id', 4)->get();
        $gawangans = self::get_subforeman($afdelling->id)->where('job_types.id', 5)->get();
        $pcontrols = self::get_subforeman($afdelling->id)->where('job_types.id', 6)->get();
        $harvestings = self::get_subforeman($afdelling->id)->where('job_types.id', 7)->get();

        return view('assistant.company.blocks', [
            'farm' => $farm,
            'company' => $company,
            'afdelling' => $afdelling,
            'blocks' => $blocks,
            'jobtypes' => $jobtypes,
            'assistant' => $assistant,
            'foremans' => $foremans,
            'sprayings' => $sprayings,
            'fertilizers' => $fertilizers,
            'circles' => $circles,
            'prunings' => $prunings,
            'gawangans' => $gawangans,
            'pcontrols' => $pcontrols,
            'harvestings' => $harvestings,
        ]);
    }

    public static function get_subforeman($afdelling_id)
    {
        return DB::table('afdellings')
            ->join('subforemans', 'subforemans.afdelling_id', '=', 'afdellings.id')
            ->join('job_types', 'job_types.id', '=', 'subforemans.jobtype_id')
            ->where('afdellings.id', $afdelling_id)->select('subforemans.name');
    }
}