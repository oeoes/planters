@extends('superadmin.layouts.app')

@section('title', 'RKH - Fertilizer')

@section('content-title', 'RKH - Fertilizer')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <span class="text-muted">Mandor utama</span>, 
                <span class="font-weight-bolder">{{ foreman($block_reference->foreman_id)->name }}</span>
                <table class="table table-striped">
                    <tr>
                        <td>Tahun Tanam</td>
                        <td>:</td>
                        <td>{{ $block_reference->planting_year }}</td>
                    </tr>
                    <tr>
                        <td>Block</td>
                        <td>:</td>
                        <td>{{ block($block_reference->block_id) }}</td>
                    </tr>
                    <tr>
                        <td>Target luas block</td>
                        <td>:</td>
                        <td>{{ $block_reference->total_coverage }} Ha</td>
                    </tr>
                    <tr>
                        <td>Luas block tersedia</td>
                        <td>:</td>
                        <td>{{ $block_reference->available_coverage }} of {{ $block_reference->total_coverage }} Ha</td>
                    </tr>
                    <tr>
                        <td>Luas populasi</td>
                        <td>:</td>
                        <td>{{ $block_reference->population_coverage }} Ha</td>
                    </tr>
                    <tr>
                        <td>Populasi perblock / SPH</td>
                        <td>:</td>
                        <td>{{ $block_reference->population_perblock }}</td>
                    </tr>
                    <tr>
                        <td>Jenis bahan</td>
                        <td>:</td>
                        <td>{{ $fertilizer->ingredients_type }}</td>
                    </tr>
                    <tr>
                        <td>Qty bahan</td>
                        <td>:</td>
                        <td>{{ $fertilizer->ingredients_amount }}</td>
                    </tr>
                    <tr>
                        <td>Catatan</td>
                        <td> : </td>
                        <td>{{ $fertilizer->subforeman_note }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                @if ($fill !== null)
                    <span class="text-muted">
                        Mandor bidang,
                        <span class="font-weight-bolder">
                            {{ subforeman($fertilizer->subforeman_id)->name }}
                        </span>
                    </span>
                @endif
                <table class="table table-striped">
                    <tr>
                        <td>Pelaksanaan</td>
                        <td> : </td>
                        <td>{{ $fill->begin }} &nbsp;<i class="fa fa-sm fa-arrow-right" aria-hidden="true"></i> {{ $fill->ended }}</td>
                    </tr>
                    <tr>
                        <td>Capaian</td>
                        <td> : </td>
                        <td>{{ $fill->ftarget_coverage }} Ha</td>
                    </tr>
                    <tr>
                        <td>Penggunaan HK</td>
                        <td> : </td>
                        <td>{{ $fertilizer->hk_used }}</td>
                    </tr>
                    <tr>
                        <td>Qty bahan</td>
                        <td> : </td>
                        <td>{{ $fill->fingredients_amount }}</td>
                    </tr>
                    <tr>
                        <td>Catatan</td>
                        <td> : </td>
                        <td>{{ $fill->subforeman_note }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
  <script>
    
  </script> 