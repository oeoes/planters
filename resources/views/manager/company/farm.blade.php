@extends('manager.layouts.app')

@section('title', 'Daftar Kebun')
@section('page-title', 'Daftar Kebun')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('manager.company') }}">Daftar Perusahaan</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $company->company_name }}</li>
    </ol>
</nav>
@endsection

@section('add-owner')
<div class="d-flex flex-row-reverse">
    <button class="btn btn-sm btn-outline-success rounded-pill pl-3 pr-3 ml-1" data-toggle="modal" data-target="#add-farm">Farm <i class="fas fa-plus ml-1"></i> </button>
    @if($company_owner)
    <button class="btn btn-sm btn-outline-info rounded-pill pl-3 pr-3">{{ ucwords($company_owner->name) }} <i class="fas fa-user mr-1"></i> </button>
    @else
    <button class="btn btn-sm btn-outline-secondary rounded-pill pl-3 pr-3" data-toggle="modal" data-target="#add-company_owner">Owner PT <i class="fas fa-user-plus mr-1"></i> </button>

    <!-- Modal add company_owner -->
    <div class="modal fade" id="add-company_owner" tabindex="-1" aria-labelledby="add-company_ownerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-company_ownerLabel">Tambah Owner PT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill pr-4 pl-4" data-dismiss="modal">Tutup</button>
                    <button id="update-account" type="submit" class="btn btn-outline-primary btn-sm rounded-pill pr-4 pl-4">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal add Farm -->
    <div class="modal fade" id="add-farm" tabindex="-1" aria-labelledby="add-farmLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-farmLabel">Tambah data kebun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('manager.farm.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Perusahaan</label>
                            <input class="form-control rounded-pill outline-danger" value="{{ ucwords($company->company_name) }}" readonly>
                            <input type="hidden" name="company_id" class="form-control" value="{{ ucwords($company->id) }}">
                        </div>

                        <div class="form-group">
                            <label for="name">Nama kebun</label>
                            <input name="farm" type="name" class="form-control rounded-pill outline-danger" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill pr-4 pl-4" data-dismiss="modal">Tutup</button>
                    <button id="update-account" type="submit" class="btn btn-outline-primary btn-sm rounded-pill pr-4 pl-4">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('content')
    <div class="row mt-4">
        @if(count($farms))
        @foreach ($farms as $key => $farm)
        <div class="col-md-3">
            <div id="wadah" class="card card-outline card-success">
                <div class="crudd__btn_cont">
                    <div class="d-flex justify-content-center mt-2">
                        <button data-toggle="modal" data-target="#edit-farm{{ $key }}" class="btn btn-sm btn-outline-primary rounded-pill pl-3 pr-3 mr-1"><i class="fa fa-pen"></i></button>
                        <button data-toggle="modal" data-target="#delete-farm{{ $key }}" class="btn btn-sm btn-outline-danger rounded-pill pl-3 pr-3"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <a href="{{ route('manager.company.farm.afdellings', $farm->id) }}">
                    <div class="card-body text-dark">
                        {{ ucwords($farm->name) }}
                    </div>
                    <div class="card-footer text-muted">
                        @if($farm->manager)
                        <span class="badge badge-sm badge-light">manager</span> {{ ucwords($farm->manager) }}
                        @else
                        <div class="text-center">Belum ditentukan</div>
                        @endif
                    </div>
                </a>
            </div>
        </div>

        <!-- Modal edit farm -->
        <div class="modal fade" id="edit-farm{{ $key }}" tabindex="-1" aria-labelledby="edit-farmLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit-farmLabel">Perbarui data Kebun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('manager.farm.update', $farm->id) }}">
                            @method('PUT')
                            @csrf

                            <div class="form-group">
                                <label for="name">Perusahaan</label>
                                <input class="form-control rounded-pill outline-danger" value="{{ ucwords($company->company_name) }}" readonly>
                                <input type="hidden" name="company_id" class="form-control" value="{{ ucwords($company->id) }}">
                            </div>

                            <div class="form-group">
                                <label for="name">Nama kebun</label>
                                <input name="farm" type="name" class="form-control rounded-pill outline-danger" value="{{ $farm->name }}" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill pr-4 pl-4" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill pr-4 pl-4">Perbarui</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal delete farm -->
        <div class="modal fade" id="delete-farm{{ $key }}" tabindex="-1" aria-labelledby="delete-farmLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delete-farmLabel">Hapus data Kebun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('manager.farm.delete', $farm->id) }}">
                            @method('DELETE')
                            @csrf
                            Yakin untuk menghapus Kebun?

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill pr-4 pl-4" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill pr-4 pl-4">Ya</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="col-md-4 offset-md-4 mt-5">
            <div class="text-muted text-center h6 mt-5">Kebun Tidak Tersedia.</div>
        </div>
        @endif
    </div>
    @endsection

    @section('js')
    <script>
        ScrollReveal().reveal('.active', {
            delay: 250
        });

        ScrollReveal().reveal('.card', {
            delay: 500
        });
    </script>
    @endsection