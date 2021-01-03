@extends('assistant.layouts.app')

@section('title', 'Pemeriksaan hancak panen')

@section('content-title')
    Pemeriksaan hancak panen
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('assistant.hancak.index') }}">Daftar sampel panen</a>
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            Tanggal panen: <span class="font-weight-bold">{{ date('d-m-Y', strtotime($hvs_date)) }}</span> <br />
            Blok : <span class="font-weight-bold">{{ block($block_id) }} </span>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Daftar pemeriksaan hancak panen</div>
        <div class="card-body">
            <table class="table table-sm">
                <thead class="bg-primary">
                    <tr>
                        <th>#</th>
                        <th style="width: 150px">Tgl pemeriksaan</th>
                        <th>HB</th>
                        <th>IC</th>
                        <th>OC</th>
                        <th>OP</th>
                        <th>HP</th>
                        <th>Tot. Loose</th>
                        <th style="width: 200px">L/F Perharvesting palm</th>
                        <th>Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gradings as $grade)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d-m-Y', strtotime($grade->date)) }}</td>
                            <td>{{ $grade->harvesting_bunch }}</td>
                            <td>{{ $grade->in_circle }}</td>
                            <td>{{ $grade->out_circle }}</td>
                            <td>{{ $grade->on_palm }}</td>
                            <td>{{ $grade->harvesting_path }}</td>
                            <td>
                                {{ $grade->in_circle + $grade->out_circle + $grade->on_palm + $grade->harvesting_path }}
                            </td>
                            <td style="text-align: center">
                                {{ number_format((float) ($grade->in_circle + $grade->out_circle + $grade->on_palm + $grade->harvesting_path) / $grade->harvesting_bunch, 2, '.', '') }}
                            </td>
                            <td>
                                <a href="{{ $grade->image }}" target="_blank" rel="noopener noreferrer">
                                    <i class="fa fa-eye" aria-hidden="true"></i> Lihat
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
