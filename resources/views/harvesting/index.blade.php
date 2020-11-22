@extends('layouts.app')

@section('title', 'Dasbor')

@section('content-title')
  <b>Panen</b> <small class="text-muted font-weight-lighter" style="font-size: 14pt">Rencana Kerja Harian</small>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="text-muted">Daftar Panen
      <div class="float-right">
        <a href="{{ route('harvesting.filter') }}">
          <i class="fa fa-filter" aria-hidden="true"></i>
          Filter
        </a>
      </div>
    </h5>
    <table class="table table-hover">
      <thead class="bg-primary">
        <tr>
          <th>#</th>
          <th>Occured</th>
          <th>Farm</th>
          <th>Afdelling</th>
          <th>Block</th>
          <th>Creator</th>
          <th>Cvg</th>
          <th>Pop</th>
          <th>AKP</th>
          <th>BJR</th>
          <th>Stat</th>
          <th>Details</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($harvestings as $hvs)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ date('d/m/Y', strtotime($hvs->date)) }}</td>
            <td>{{ str_farm($hvs->farm_id) }}</td>
            <td>{{ str_afdelling($hvs->afdelling_id) }}</td>
            <td>{{ str_block($hvs->block_id) }}</td>
            <td>{{ str_foreman1($hvs->foreman1_id) }}</td>
            <td>{{ $hvs->coverage }} Ha</td>
            <td>{{ $hvs->population }}</td>
            <td>{{ $hvs->akp }}</td>
            <td>{{ $hvs->bjr }}</td>
            <td>
              @if ($hvs->active)
                <span class="badge badge-primary">On going</span>
              @else
                <span class="badge badge-danger">Closed</span>
              @endif
            </td>
            <td>more...</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection