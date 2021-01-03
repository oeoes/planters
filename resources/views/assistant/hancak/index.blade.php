@extends('assistant.layouts.app')

@section('title', 'Daftar Kelola Hancak')

@section('content-title')
    Daftar kelola hancak
@endsection

@section('content')
    <div class="card">
        <div class="card-header">Daftar sample panen</div>
        <div class="card-body">
            <table class="table table-sm">
                <thead class="bg-primary">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Tahun tanam</th>
                        <th>Blok</th>
                        <th>Mandor utama</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $sample)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d-m-Y', strtotime($sample->date)) }}</td>
                            <td>{{ $sample->planting_year }}</td>
                            <td>{{ block($sample->block_id) }}</td>
                            <td>{{ foreman($sample->foreman_id)->name }}</td>
                            <td style="text-align: right">
                                <a href="{{ route('assistant.hancak.checking', [$sample->id, $sample->date]) }}" class="btn btn-default">Pemeriksaan Hancak Panen &nbsp; <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
