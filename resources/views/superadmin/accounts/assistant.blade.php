@extends('superadmin.layouts.app')

@section('title', 'Asisten Kebun')
@section('page-title')
{{ $afdelling->name }}
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
                        <th>Afdelling</th>
                        <th>Change Ownership</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assistants as $key => $assistant)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $assistant->name }}</td>
                        <td>{{ $assistant->email }}</td>
                        <td>
                            @if($assistant->afdelling)
                            <span class="text-muted">{{ $assistant->afdelling->name }}</span>
                            @else
                            <span class="badge badge-warning">Empty</span>
                            @endif
                        </td>
                        @if ($assistant->afdelling == $afdelling)
                        <td><button class="btn btn-success btn-sm rounded-pill pr-4 pl-4">Current</button></td>
                        @else
                        <td><a href="{{ route('superadmin.company.farm.afdelling.grant.assistant', ['afdelling' => $afdelling->id, 'assistant' => $assistant->id]) }}" class="btn btn-primary btn-sm rounded-pill pr-4 pl-4">Select</a></td>
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
                Add Farm Assistant
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('superadmin.user.assistant.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Farm</label>
                        <input class="form-control rounded-pill outline-danger" value="{{ ucwords($afdelling->farm->name) }}" readonly>
                        <input type="hidden" name="farm_id" class="form-control" value="{{ $afdelling->farm->id }}">
                    </div>

                    <div class="form-group">
                        <label for="name">Afdelling</label>
                        <input class="form-control rounded-pill outline-danger" value="{{ ucwords($afdelling->name) }}" readonly>
                        <input type="hidden" name="afdelling_id" class="form-control" value="{{ $afdelling->id }}">
                    </div>

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