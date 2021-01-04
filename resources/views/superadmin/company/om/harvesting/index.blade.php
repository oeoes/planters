@extends('superadmin.layouts.app')

@section('title', 'Operating Maintenance Harvesting')
@section('page-title', 'Operating Maintenance Harvesting')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('superadmin.company') }}">Daftar Perusahaan</a></li>
        <li class="breadcrumb-item"><a href="{{ route('superadmin.company.farm', $company->id) }}">{{ ucwords($company->company_name) }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('superadmin.company.farm.afdellings', $farm->id) }}">{{ ucwords($farm->name) }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('superadmin.company.farm.afdelling.operating_maintenance', $afdelling->id) }}">{{ ucwords($afdelling->name) }} (OM)</a></li>
        <li class="breadcrumb-item active" aria-current="page">Harvesting</li>
    </ol>
</nav>
@endsection

@section('add-owner')
<div class="d-flex flex-row-reverse">
    <a href="{{ route('superadmin.harvesting.history') }}" class="btn btn-sm btn-outline-info rounded-pill ml-1"><span class="">View History </span> <i class="fas fa-history ml-1 mr-1"></i> </a>
</div>
@endsection


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card table-responsive">
            <table id="myTable" class="table table-hover table-borderless">
                <thead class="text-muted bg-primary">
                    <tr>
                        <th>#</th>
                        <th>Mandor utama</th>
                        <th>Tahun tanam</th>
                        <th>Tanggal</th>
                        <th>Total coverage</th>
                        <th>Available coverage</th>
                        <th>Population coverage</th>
                        <th>Population perblock</th>
                        <th>Block</th>
                        <th>Mandor Bidang</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($harvestings as $key => $harvesting)
                    <tr>
                        <td scope="row">{{ $key+1 }}</td>
                        <td>{{ $harvesting->foreman }}</td>
                        <td>{{ $harvesting->planting_year }}</td>
                        <td>{{ $harvesting->date }}</td>
                        <td>{{ $harvesting->total_coverage }} Ha</td>
                        <td>{{ $harvesting->available_coverage }} Ha</td>
                        <td>{{ $harvesting->population_coverage }} Ha</td>
                        <td>{{ $harvesting->population_perblock }}</td>
                        <td>{{ $harvesting->block }}</td>
                        <td>{{ $harvesting->subforeman }}</td>
                        <td>
                            <a href="" class="btn btn-sm rounded-pill btn-outline-info pl-3 pr-3" data-toggle="modal" data-target="#edit-farm{{$key}}"><i class="nav-icon fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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