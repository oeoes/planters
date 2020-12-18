@extends('superadmin.layouts.app')

@section('title', 'Daftar Perusahaan')

@section('content-title')
    Daftar Perusahaan
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead class="bg-primary">
                    <tr>
                        <th>#</th>
                        <th>Company Code</th>
                        <th>Company name</th>
                        <th style="width: 150px">Area</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $company->company_code }}</td>
                            <td>{{ $company->company_name }}</td>
                            <td>
                                <a href="{{ route('superadmin.company.area', $company->id) }}" class="btn btn-sm rounded-pill btn-outline-info pl-3 pr-3">
                                    <i class="nav-icon fas fa-eye"></i>
                                    Detail area
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script>

    </script>
@endsection
