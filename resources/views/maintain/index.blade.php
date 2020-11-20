@extends('layouts.app')

@section('title', 'Dasbor')

@section('content-title')
  <b>Rawat</b> <small class="text-muted font-weight-lighter" style="font-size: 14pt">Rencana Kerja Harian</small>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <span class="h5 text-muted">Filter</span>
    <form action="{{ route('maintain.filter') }}" method="post">
      @csrf
      <div class="form-row align-items-center">
        <div class="col-auto">
          <select class="form-control form-control-sm" name="farm" id="farm">
            <option value="#">Select farm</option>
            @foreach ($farms as $farm)
              <option value="{{ $farm->id }}">{{ $farm->id }} - {{ $farm->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-auto">
          <select class="form-control form-control-sm" id="afdelling" name="afdelling">
            <option value="#">Select afdelling</option>
          </select>
        </div>
        <div class="col-auto">
          <select class="form-control form-control-sm" id="block" name="block">
            <option value="#">Select block</option>
          </select>
        </div>
        <div class="col-auto">
          <select class="form-control form-control-sm" id="period" name="period">
            <option value="#">Select Period</option>
            <option value="1">Period: 1</option>
            <option value="2">Period: 2</option>
            {{-- <option value="3">Period: 1 & 2</option> --}}
          </select>
        </div>
        <div class="col-auto">
          <select class="form-control form-control-sm" id="pyear" name="pyear">
            <option value="#">Select year</option>
            @php
                $old_date = date('Y') -1;
                $current_date = date('Y');
            @endphp
            <option value="{{ $old_date }}">{{ $old_date }}</option>
            <option value="{{ $current_date }}">{{ $current_date }}</option>

          </select>
        </div>
          <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-filter" aria-hidden="true"></i>
            Filter
          </button>
          <a href="{{ route('maintain.index') }}" class="btn btn-sm"> 
            Refresh
          </a>
      </div>
    </form>
  </div>
</div>
<div class="card">
  <div class="card-body">
    {{-- 
      'farm' => $farm,
      'afdelling' => $afdelling,
      'block' => $block,
      'total_harvest_completeness' => $total_gawangan_completeness,
      'total_harvest_coverage_final' => $total_harvest_coverage_final,
      'total_spraying_completeness' => $total_spraying_completeness,
      'total_spraying_coverage_final' => $total_spraying_coverage_final,
      'total_circle_completeness' => $total_circle_completeness,
      'total_circle_coverage_final' => $total_circle_coverage_final,
      'total_pruning_completeness' => $total_pruning_completeness,
      'total_pruning_coverage_final' => $total_pruning_coverage_final,
      'total_gawangan_completeness' => $total_gawangan_completeness,
      --}}
    @if (session()->has('data'))
      <div class="text-muted h5">
        <h5>
          <span class="badge badge-primary">
          Pencarian untuk Kebun: {{ session('data')['farm'] }}, Afdelling {{ session('data')['afdelling'] }}, Blok {{ session('data')['block'] }}
          </span>
        </h5>
      </div>
      <table class="table col-8">
        <tr>
          <td rowspan="2">Pupuk</td>
          <td>Ketuntasan pekerjaan</td>
          <td>{{ session('data')['total_harvest_completeness'] }}</td>
        </tr>
        <tr>
          <td>Coverage</td>
          <td>{{ session('data')['total_harvest_coverage_final'] }}</td>
        </tr>
        <tr>
          <td rowspan="2">Spraying</td>
          <td>Ketuntasan pekerjaan</td>
          <td>{{ session('data')['total_spraying_completeness'] }}</td>
        </tr>
        <tr>
          <td>Coverage</td>
          <td>{{ session('data')['total_spraying_coverage_final'] }}</td>
        </tr>
        <tr>
          <td rowspan="2">Manual Circle</td>
          <td>Ketuntasan pekerjaan</td>
          <td>{{ session('data')['total_circle_completeness'] }}</td>
        </tr>
        <tr>
          <td>Coverage</td>
          <td>{{ session('data')['total_circle_coverage_final'] }}</td>
        </tr>
        <tr>
          <td rowspan="2">Manual Pruning</td>
          <td>Ketuntasan pekerjaan</td>
          <td>{{ session('data')['total_pruning_completeness'] }}</td>
        </tr>
        <tr>
          <td>Coverage</td>
          <td>{{ session('data')['total_pruning_coverage_final'] }}</td>
        </tr>
        <tr>
          <td>Manual Gawangan</td>
          <td>Ketuntasan pekerjaan</td>
          <td>{{ session('data')['total_gawangan_completeness'] }}</td>
        </tr>
      </table>
    @endif
  </div>
</div>
@endsection

@section('js')
  <script>
    $(document).ready(function() {
      $('#farm').on('change', function() {
        let farm_id = $(this).val();
          $.ajax({
            type: 'POST',
            url: '/area/afdelling/getafdelling/',
            data: {
              farm_id: farm_id,
              _token: "{{ csrf_token() }}",
            },
            success: function (res) {
              console.log(res);
              if (res.length > 1) {
                $("#afdelling").empty();
                $("#block").empty();
                $("#block").append('<option>Select block</option>')
                $("#afdelling").append('<option>Select afdelling</option>');
                $.each(res, function (key, value) {
                  let row = `<option value=${value['id']}>${value['name']}</option>`;
                  $("#afdelling").append(row)
                }) 
              } else {
                $("#afdelling").empty();
                $("#afdelling").append('<option>Select afdelling</option>');
              }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              console.log(xhr.status);
              console.log(thrownError);
              console.log($('meta[name="csrf-token"]').attr('content'));
            }
          });
      });

      $("#afdelling").on('change', function() {
        let afdelling_id = $(this).val();
        console.log(afdelling_id);
          $.ajax({
            type: 'POST',
            url: '/area/block/getblock/',
            data: {
              afdelling_id: afdelling_id,
              _token: "{{ csrf_token() }}",
            },
            success: function(res) {
              if (res.length > 1) {
                $("#block").empty();
                $("#block").append('<option>Select block</option>')
                $.each(res, function (key, value) {
                  let row = `<option value=${value['id']}>${value['name']}</option>`;
                  $("#block").append(row)
                })          
              } else {
                $("#block").empty();
                $("#block").append('<option>Select block</option>')
              }
            }
          })
      })
    });
  </script>
@endsection