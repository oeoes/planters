@extends('superadmin.layouts.app')

@section('title', 'History RKH - Spraying')

@section('content-title')
  History RKH - Spraying 
@endsection

@section('content')
<div class="card col-md-6">
    <table class="table" id="myTable">
        <thead class="bg-primary">
            <tr>
                <th>#</th>
                <th>Block</th>
                <th>Tahun tanam</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($block_references as $ref)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ block($ref->block_id) }}</td>
                    <td>{{ $ref->planting_year }}</td>
                    <td>
                        <a href="{{ route('superadmin.spraying.history.detail', $ref->id) }}" class="btn btn-sm rounded-pill btn-outline-info pl-3 pr-3"><i class="nav-icon fas fa-eye"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection