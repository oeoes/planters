@extends('layouts.app')

@section('title', 'Dasbor')

@section('content-title')
  <b>Panen</b> <small class="text-muted font-weight-lighter" style="font-size: 14pt">Rencana Kerja Harian</small>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <span class="h5 text-muted">Filter</span>
    <form action="{{ route('harvesting.filter.process') }}" method="post">
      @csrf
      <div class="form-row align-items-center">
        <div class="col-auto">
          <select class="form-control form-control-sm" name="farm" id="farm">
            <option value="0">Select farm</option>
            @foreach ($farms as $farm)
              <option value="{{ $farm->id }}">{{ $farm->id }} - {{ $farm->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-auto">
          <select class="form-control form-control-sm" id="afdelling" name="afdelling">
            <option value="0">Select afdelling</option>
          </select>
        </div>
        <div class="col-auto">
          <select class="form-control form-control-sm" id="block" name="block">
            <option value="0">Select block</option>
          </select>
        </div>
        <div class="col-auto">
          <div class="input-group">
            {{-- <div class="input-group-prepend">
              <span class="input-group-text">First and last name</span>
            </div> --}}
            <input type="date" class="form-control form-control-sm" name="date_start" placeholder="Dari tanggal">
            <input type="date" class="form-control form-control-sm" name="date_end" placeholder="Sampai tanggal">
          </div>
        </div>
          <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-filter" aria-hidden="true"></i>
          </button>
          <a href="{{ route('maintain.index') }}" class="btn btn-sm"> 
            Refresh
          </a>
      </div>
    </form>
    <small class="font-wight-bold text-danger">*Filtering work only for Inactive RKH</small>
  </div>
</div>

    @if (session()->has('data'))
    @php
        $data = session('data')
    @endphp
      <div class="card">
        <div class="card-body">
          <div>
            Pencarian untuk [XX XX XX XX]
            <table class="table col-8">
              @foreach (session('data') as $data)
                <tr>
                  <td>Jumlah karyawan :</td>
                  <td>{{ $data['employee_used'] }}</td>
                </tr>
                <tr>
                  <td>Persentase jumlah karyawan {{ $data['employee_used'] }} of {{ $data['employee_allocation'] }}:</td>
                  <td>{{ $data['employee_percentage'] }} %</td>
                </tr>
                <tr>
                  <td>Produksi panen total:</td>
                  <td>{{ $data['total_harvest_production'] }}</td>
                </tr>
                <tr>
                  <td>Ketuntasan panen:</td>
                  <td>{{ $data['harvest_completeness'] }}</td>
                </tr>
                <tr>
                  <td>Rerata lama panen:</td>
                  <td>{{ $data['harvest_total_minutes'] }}</td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    @endif

@endsection

@section('returnbtn')
    <a href="{{ route('harvesting.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Daftar RKH Panen</a>
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

