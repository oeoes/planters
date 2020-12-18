<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Afdelling;
use App\Models\Block;
use App\Models\Company;
use App\Models\Farm;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index () {
        $companies = Company::all();
        return view('superadmin.company.index', [
            'companies' => $companies
        ]);
    }

    public function areas ($company_id) {
        $farms = Farm::where('company_id', $company_id)->get();
        $company = Company::find($company_id);
        return view('superadmin.company.areas', [
            'farms' => $farms,
            'company' => $company->company_name
        ]);
    }

    public function afdellings ($farm_id) {
        $afdellings = Afdelling::where('farm_id', $farm_id)->get();
        // dd($afdellings);
        session()->put('afdellings', $afdellings);
        session()->put('farm_id', $farm_id);
        session()->forget('afdelling_id');
        session()->forget('blocks');
        return back();
    }

    public function blocks ($afdelling_id) {
        $blocks = Block::where('afdelling_id', $afdelling_id)->get();
        session()->put('blocks', $blocks);
        session()->put('afdelling_id', $afdelling_id);
        return back();
    }
}
