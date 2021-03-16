@extends('superadmin.layouts.app')

@section('title', 'Pemilik PT')
@section('page-title')
{{ $company->company_name }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card table-responsive shadow-sm">
            <table id="myTable" class="table table-hover table-borderless" style="font-size:11pt">
                <thead class="text-muted">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Change Ownership</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($owners as $key => $owner)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $owner->name }}</td>
                        <td>{{ $owner->email }}</td>
                        <td>
                            <ol>
                                @forelse($owner->companies as $cp)
                                <li class="text-muted">{{ $cp->company_name }}</li>
                                @empty
                                <li class="badge badge-warning">Empty</li>
                                @endforelse
                            </ol>
                        </td>
                        @if ($owner->companies->contains($company))
                        <td><button class="btn btn-success btn-sm rounded-pill pr-4 pl-4">Current</button></td>
                        @else
                        <td><a href="{{ route('superadmin.company.grant.owner', ['company' => $company->id, 'agency' => $owner->id]) }}" class="btn btn-primary btn-sm rounded-pill pr-4 pl-4">Select</a></td>
                        @endif
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-header">
                Add owner
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('superadmin.company.store.agency') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input name="name" type="name" class="form-control rounded-pill outline-danger" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control rounded-pill outline-danger" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control rounded-pill" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill pr-4 pl-4">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection