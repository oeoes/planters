<?php

namespace App\Http\Controllers\manager;

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

    public function afdellings()
    { 
        $farm = Farm::find(auth()->guard('farmmanager')->user()->farm_id);
        $manager = Farm::find($farm->id)->manager;
        $company = Company::find($farm->company_id);
        $afdellings = DB::table('afdellings')->leftJoin('assistants', 'afdellings.id', '=', 'assistants.afdelling_id')
        ->where('afdellings.farm_id', $farm->id)
            ->select('afdellings.id', 'afdellings.hk_total', 'afdellings.name', 'assistants.name as assistant')->get();

        return view('manager.company.afdelling', [
            'farm' => $farm,
            'manager' => $manager,
            'company' => $company,
            'afdellings' => $afdellings,
        ]);
    }

    public static function get_subforeman($afdelling_id)
    {
        return DB::table('afdellings')
        ->join('subforemans', 'subforemans.afdelling_id', '=', 'afdellings.id')
        ->join('job_types', 'job_types.id', '=', 'subforemans.jobtype_id')
        ->where('afdellings.id', $afdelling_id)->select('subforemans.name');
    }

    public function blocks(Afdelling $afdelling_id)
    {
        $farm = Farm::find($afdelling_id->farm_id);
        $company = Company::find($farm->company_id);
        $assistant = Afdelling::find($afdelling_id->id)->assistant;
        $blocks = Block::where('afdelling_id', $afdelling_id->id)->get();
        $foremans = $afdelling_id->foreman;
        $jobtypes = JobType::all();

        $sprayings = self::get_subforeman($afdelling_id->id)->where('job_types.id', 1)->get();
        $fertilizers = self::get_subforeman($afdelling_id->id)->where('job_types.id', 2)->get();
        $circles = self::get_subforeman($afdelling_id->id)->where('job_types.id', 3)->get();
        $prunings = self::get_subforeman($afdelling_id->id)->where('job_types.id', 4)->get();
        $gawangans = self::get_subforeman($afdelling_id->id)->where('job_types.id', 5)->get();
        $pcontrols = self::get_subforeman($afdelling_id->id)->where('job_types.id', 6)->get();
        $harvestings = self::get_subforeman($afdelling_id->id)->where('job_types.id', 7)->get();

        return view('manager.company.blocks', [
            'farm' => $farm,
            'company' => $company,
            'afdelling' => $afdelling_id,
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

    public function operating_maintenance(Afdelling $afdelling_id)
    {
        $farm = Farm::find($afdelling_id->farm_id);
        $company = Company::find($farm->company_id);
        $assistant = Afdelling::find($afdelling_id->id)->assistant;

        return view('manager.company.operating-maintenance')->with([
            'farm' => $farm,
            'company' => $company,
            'afdelling' => $afdelling_id,
            'assistant' => $assistant,
        ]);
    }

    public function operating_maintenance_spraying(Afdelling $afdelling_id)
    {
        $farm = Farm::find($afdelling_id->farm_id);
        $company = Company::find($farm->company_id);
        $assistant = Afdelling::find($afdelling_id->id)->assistant;

        $sprayings = SprayingType::all();

        return view('manager.company.om.spraying.index')->with([
            'farm' => $farm,
            'company' => $company,
            'afdelling' => $afdelling_id,
            'assistant' => $assistant,
            'sprayings' => $sprayings,
        ]);
    }

    public function operating_maintenance_fertilizer(Afdelling $afdelling_id)
    {
        $farm = Farm::find($afdelling_id->farm_id);
        $company = Company::find($farm->company_id);
        $assistant = Afdelling::find($afdelling_id->id)->assistant;

        $fertilizers = FertilizerType::all();

        return view('manager.company.om.fertilizer.index')->with([
            'farm' => $farm,
            'company' => $company,
            'afdelling' => $afdelling_id,
            'assistant' => $assistant,
            'fertilizers' => $fertilizers,
        ]);
    }

    public function operating_maintenance_circle(Afdelling $afdelling_id)
    {
        $farm = Farm::find($afdelling_id->farm_id);
        $company = Company::find($farm->company_id);
        $assistant = Afdelling::find($afdelling_id->id)->assistant;

        $circles = CircleType::all();

        return view('manager.company.om.circle.index')->with([
            'farm' => $farm,
            'company' => $company,
            'afdelling' => $afdelling_id,
            'assistant' => $assistant,
            'circles' => $circles,
        ]);
    }

    public function operating_maintenance_pruning(Afdelling $afdelling_id)
    {
        $farm = Farm::find($afdelling_id->farm_id);
        $company = Company::find($farm->company_id);
        $assistant = Afdelling::find($afdelling_id->id)->assistant;

        $prunings = PruningType::all();

        return view('manager.company.om.pruning.index')->with([
            'farm' => $farm,
            'company' => $company,
            'afdelling' => $afdelling_id,
            'assistant' => $assistant,
            'prunings' => $prunings,
        ]);
    }

    public function operating_maintenance_gawangan(Afdelling $afdelling_id)
    {
        $farm = Farm::find($afdelling_id->farm_id);
        $company = Company::find($farm->company_id);
        $assistant = Afdelling::find($afdelling_id->id)->assistant;

        $gawangans = GawanganType::all();

        return view('manager.company.om.gawangan.index')->with([
            'farm' => $farm,
            'company' => $company,
            'afdelling' => $afdelling_id,
            'assistant' => $assistant,
            'gawangans' => $gawangans,
        ]);
    }

    public function operating_maintenance_pcontrol(Afdelling $afdelling_id)
    {
        $farm = Farm::find($afdelling_id->farm_id);
        $company = Company::find($farm->company_id);
        $assistant = Afdelling::find($afdelling_id->id)->assistant;

        $pestcontrols = PestControl::all();

        return view('manager.company.om.pcontrol.index')->with([
            'farm' => $farm,
            'company' => $company,
            'afdelling' => $afdelling_id,
            'assistant' => $assistant,
            'pestcontrols' => $pestcontrols,
        ]);
    }

    public function operating_maintenance_harvesting(Afdelling $afdelling_id)
    {
        $farm = Farm::find($afdelling_id->farm_id);
        $company = Company::find($farm->company_id);
        $assistant = Afdelling::find($afdelling_id->id)->assistant;

        $harvestings = HarvestingType::all();

        return view('manager.company.om.harvesting.index')->with([
            'farm' => $farm,
            'company' => $company,
            'afdelling' => $afdelling_id,
            'assistant' => $assistant,
            'harvestings' => $harvestings,
        ]);
    }
}
