@extends('manager.layouts.app')

@section('title', 'Operating Maintenance Fertilizer')
@section('page-title', 'Operating Maintenance Fertilizer')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><strong>{{ $company->company_name }}</strong></li>
        <li class="breadcrumb-item"><a href="{{ route('manager.farm.afdellings', $farm->id) }}">{{ ucwords($farm->name) }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('manager.farm.afdelling.operating_maintenance', $afdelling->id) }}">{{ ucwords($afdelling->name) }} (OM)</a></li>
        <li class="breadcrumb-item active" aria-current="page">Fertilizer</li>
    </ol>
</nav>
@endsection

@section('add-owner')
<div class="d-flex flex-row-reverse">
    <a href="{{ route('manager.fertilizer.history') }}" class="btn btn-sm btn-outline-info rounded-pill ml-1"><span class="">View History </span> <i class="fas fa-history ml-1 mr-1"></i> </a>
</div>
@endsection


@section('content')
<div class="card col-md-12 table-responsive">
    <table id="myTable" class="table table-hover table-borderless" style="font-size:11pt">
        <thead class="text-muted bg-primary">
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Man. utama</th>
                <th>Tot. cov</th>
                <th>Pop. cov</th>
                <th>SPH</th>
                <th>Man. bidang</th>
                <th>Pekerjaan</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fertilizers as $key => $fertilizer)
            @php $reference = App\Models\BlockReference::find($fertilizer->block_ref_id); @endphp
            <tr>
                <td scope="row">{{ $key+1 }}</td>
                <td>{{ date('d-m-Y', strtotime($fertilizer->date))}}</td>
                <td>{{ foreman($fertilizer->foreman_id)->name }}</td>
                <td>{{ $reference->total_coverage }} Ha</td>
                <td>{{ $reference->population_coverage }} Ha</td>
                <td>{{ $reference->population_perblock }}</td>
                <td>{{ subforeman($fertilizer->subforeman_id)->name }}</td>
                <td>{{ jobtype($reference->jobtype_id) }}</td>
                <td>
                    <a href="{{ route('manager.fertilizer.detail', [$fertilizer->block_ref_id, $fertilizer->id]) }}" class="btn btn-default btn-sm">
                        {{ $reference->planting_year }} - {{ block($reference->block_id) }}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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