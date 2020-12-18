<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Afdelling;
use App\Models\Block;
use App\Models\Company;
use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index () {
        $companies = Company::all();
        return view('superadmin.company.index', [
            'companies' => $companies
        ]);
    }

    public function store (Request $request) {
        Company::create([
            'company_code' => $request->company_code,
            'company_name' => $request->company_name,
        ]);
        return back()->withSuccess('PT created');
    }

    public function update (Request $request, Company $company) {
        $company->update([
            'company_code' => $request->company_code,
            'company_name' => $request->company_name,
        ]);
        return back()->withSuccess('PT updated');
    }

    public function delete (Request $request, Company $company) {
        try {
            $company->delete();
        } catch (\Throwable $th) {
            return back()->withError('Cannot delete selected PT');
        }        
        return back()->withSuccess('PT deleted');
    }

    public function farm ($company_id) {
        $farms = DB::table('farms')
                ->leftJoin('farm_managers', 'farms.id', '=', 'farm_managers.farm_id')
                ->where('farms.company_id', $company_id)
                ->select('farms.id', 'farms.name', 'farm_managers.name as manager')->get();
        $company = Company::find($company_id);
        $company_owner = Null;
        return view('superadmin.company.farm', [
            'farms' => $farms,
            'company' => $company,
            'company_owner' => $company_owner
        ]);
    }

    public function afdellings ($farm_id) {
        $farm = Farm::find($farm_id);
        $manager = Farm::find($farm_id)->manager;
        $company = Company::find($farm->company_id);
        $afdellings = DB::table('afdellings')->leftJoin('assistants', 'afdellings.id', '=', 'assistants.afdelling_id')
                    ->where('afdellings.farm_id', $farm_id)
                    ->select('afdellings.id', 'afdellings.hk_total', 'afdellings.name', 'assistants.name as assistant')->get();
        
        return view('superadmin.company.afdelling', [
            'farm' => $farm,
            'manager' => $manager,
            'company' => $company,
            'afdellings' => $afdellings,
        ]);
    }

    public function blocks(Afdelling $afdelling_id)
    {
        $farm = Farm::find($afdelling_id->farm_id);
        $company = Company::find($farm->company_id);
        $assistant = Afdelling::find($afdelling_id->id)->assistant;
        $blocks = Block::where('afdelling_id', $afdelling_id->id)->get();

        return view('superadmin.company.blocks', [
            'farm' => $farm,
            'company' => $company,
            'afdelling' => $afdelling_id,
            'blocks' => $blocks,
            'assistant' => $assistant
        ]);
    }
}
