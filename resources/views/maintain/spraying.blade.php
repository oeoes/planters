@extends('layouts.app')

@section('title', 'PLANTERS - Dashboard')

@section('content-title')
  <b>Spraying</b> <small class="text-muted font-weight-lighter" style="font-size: 14pt">Rencana Kerja Harian</small>
@endsection

@section('css')
@endsection

@section('breadcumb')
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>date</th>
                <th>Foreman</th>
                <th>Jenis bahan</th>
                <th>Jumlah bahan</th>
                <th>Target luas</th>
                <th>Pengg. HK</th>
                <th>Note</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
                
            @endphp
            <tr>

            </tr>
        </tbody>
    </table>
  </div>
</div>
@endsection

@section('js')
  <script>
    
  </script>
@endsection