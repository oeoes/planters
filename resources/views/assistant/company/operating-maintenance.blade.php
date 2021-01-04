@extends('assistant.layouts.app')

@section('title', 'Operating Maintenance')
@section('page-title', 'Operating Maintenance')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><strong>{{ $company->company_name }}</strong></li>
        <li class="breadcrumb-item"><a href="{{ route('assistant.farm.afdellings', $farm->id) }}">{{ ucwords($farm->name) }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ ucwords($afdelling->name) }} (OM)</li>
    </ol>
</nav>
@endsection


@section('content')
<div class="row mt-4">
    <div class="col-md-4">
        <a href="{{ route('assistant.farm.afdelling.operating_maintenance_spraying', $afdelling->id) }}">
            <div class="card bg-spraying card-om">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <span class="badge badge-sm badge-spraying">Operating Maintenance</span>
                            <div class="h4">Spraying</div>
                        </div>
                        <div class="col-3">
                            <div class="d-flex flex-row-reverse">
                                <span class="" style="font-size: 30pt;"><i class="fas fa-wind"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('assistant.farm.afdelling.operating_maintenance_fertilizer', $afdelling->id) }}">
            <div class="card bg-fertilizer card-om">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <span class="badge badge-sm badge-fertilizer">Operating Maintenance</span>
                            <div class="h4">Fertilizer</div>
                        </div>
                        <div class="col-3">
                            <div class="d-flex flex-row-reverse">
                                <span class="" style="font-size: 30pt;"><i class="fas fa-seedling"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('assistant.farm.afdelling.operating_maintenance_circle', $afdelling->id) }}">
            <div class="card bg-circle card-om">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <span class="badge badge-sm badge-circle">Operating Maintenance</span>
                            <div class="h4">Manual Circle</div>
                        </div>
                        <div class="col-3">
                            <div class="d-flex flex-row-reverse">
                                <span class="" style="font-size: 30pt;"><i class="fas fa-leaf"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('assistant.farm.afdelling.operating_maintenance_pruning', $afdelling->id) }}">
            <div class="card bg-pruning card-om">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <span class="badge badge-sm badge-pruning">Operating Maintenance</span>
                            <div class="h4">Manual Pruning</div>
                        </div>
                        <div class="col-3">
                            <div class="d-flex flex-row-reverse">
                                <span class="" style="font-size: 30pt;"><i class="fas fa-cut"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('assistant.farm.afdelling.operating_maintenance_gawangan', $afdelling->id) }}">
            <div class="card bg-gawangan card-om">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <span class="badge badge-sm badge-gawangan">Operating Maintenance</span>
                            <div class="h4">Manual Gawangan</div>
                        </div>
                        <div class="col-3">
                            <div class="d-flex flex-row-reverse">
                                <span class="" style="font-size: 30pt;"><i class="fas fa-tractor"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('assistant.farm.afdelling.operating_maintenance_pcontrol', $afdelling->id) }}">
            <div class="card bg-pcontrol card-om">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <span class="badge badge-sm badge-pcontrol">Operating Maintenance</span>
                            <div class="h4">Pest Control</div>
                        </div>
                        <div class="col-3">
                            <div class="d-flex flex-row-reverse">
                                <span class="" style="font-size: 30pt;"><i class="fas fa-bug"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('assistant.farm.afdelling.operating_maintenance_harvesting', $afdelling->id) }}">
            <div class="card bg-harvesting card-om">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <span class="badge badge-sm badge-harvesting">Operating Maintenance</span>
                            <div class="h4">Harvesting</div>
                        </div>
                        <div class="col-3">
                            <div class="d-flex flex-row-reverse">
                                <span class="" style="font-size: 30pt;"><i class="fab fa-pagelines"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection

@section('js')
<script>
    ScrollReveal().reveal('.active', {
        delay: 250
    });

    ScrollReveal().reveal('.card', {
        delay: 500
    });
</script>
@endsection