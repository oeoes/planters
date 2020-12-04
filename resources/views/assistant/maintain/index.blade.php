@extends('root.app')

@section('web-title', 'Dasbor')

@section('content-title')
  <b>Rawat</b> <small class="text-muted font-weight-lighter" style="font-size: 14pt">Rencana Kerja Harian</small>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="text-muted">Daftar Rawat
      <div class="float-right">
        <a href="{{ route('maintain.filter') }}">
          <i class="fa fa-filter" aria-hidden="true"></i>
          Filter
        </a>
      </div>
    </h5>
    <table class="table table-hover" style="font-size:10pt">
      <thead class="bg-primary">
        <tr>
          <th>#</th>
          <th>Occured</th>
          <th>Farm</th>
          <th>Afdelling</th>
          <th>Block</th>
          <th>Creator</th>
          <th>Employees</th>
          <th>Period</th>
          <th>Year</th>
          <th>Cov</th>
          <th>Details</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($maintains as $mtn)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ date('d/m/Y', strtotime($mtn->created_at)) }}</td>
            <td>{{ str_farm($mtn->farm_id) }}</td>
            <td>{{ str_afdelling($mtn->afdelling_id) }}</td>
            <td>{{ str_block($mtn->block_id) }}</td>
            <td>{{ str_foreman1($mtn->foreman1_id) }}</td>
            <td>{{ $mtn->employees_numner }}</td>
            <td>{{ $mtn->period }}</td>
            <td>{{ $mtn->planting_year }}</td>
            <td>{{ $mtn->coverage }}</td>
            <td>more ..</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection