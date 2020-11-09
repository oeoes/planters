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
          @csrf
          <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-filter" aria-hidden="true"></i>
            Filter
          </button>
      </div>
    </form>
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