@extends('superadmin.layouts.app')

@section('title', 'Daftar Afdelling')
@section('page-title', 'Daftar Afdelling')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('superadmin.company') }}">Daftar Perusahaan</a></li>
        <li class="breadcrumb-item"><a href="{{ route('superadmin.company.farm', $company->id) }}">{{ $company->company_name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ ucwords($farm->name) }}</li>
    </ol>
</nav>
@endsection

@section('add-owner')
<div class="d-flex flex-row-reverse">
    <button class="btn btn-sm btn-outline-info rounded-pill pl-3 pr-3 ml-1" data-toggle="modal" data-target="#add-afdelling">Afdelling <i class="fas fa-plus ml-1"></i> </button>
    @if($manager)
    <button class="btn btn-sm btn-outline-primary rounded-pill pl-3 pr-3">{{ ucwords($manager->name) }} <i class="fas fa-user mr-1"></i> </button>
    @else
    <button class="btn btn-sm btn-outline-secondary rounded-pill pl-3 pr-3" data-toggle="modal" data-target="#add-manager">Manager Kebun <i class="fas fa-user-plus ml-1"></i> </button>

    <!-- Modal add manager -->
    <div class="modal fade" id="add-manager" tabindex="-1" aria-labelledby="add-managerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-managerLabel">Tambah manager pada kebun ini</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('superadmin.user.manager.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Farm</label>
                            <input class="form-control rounded-pill outline-danger" value="{{ ucwords($farm->name) }}" readonly>
                            <input type="hidden" name="farm_id" class="form-control" value="{{ $farm->id }}">
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

    <!-- Modal add Afdelliing -->
    <div class="modal fade" id="add-afdelling" tabindex="-1" aria-labelledby="add-afdellingLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-afdellingLabel">Tambah data afdelling</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('superadmin.afdelling.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Farm</label>
                            <input class="form-control rounded-pill outline-danger" value="{{ ucwords($farm->name) }}" readonly>
                            <input type="hidden" name="farm_id" class="form-control" value="{{ $farm->id }}">
                        </div>

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input name="afdelling" type="name" class="form-control rounded-pill outline-danger" required>
                        </div>

                        <div class="form-group">
                            <label for="email">HK total</label>
                            <input name="hk_total" type="text" class="form-control rounded-pill outline-danger" required>
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
    <div class="row">
        @if(count($afdellings))
        @foreach ($afdellings as $key => $afdelling)
        <div class="col-md-3">
            <div id="wadah" class="card card-outline card-primary">
                <div class="crudd__btn_cont">
                    <div class="d-flex justify-content-center mt-2">
                        <button data-toggle="modal" data-target="#edit-afdelling{{ $key }}" class="btn btn-sm btn-outline-primary rounded-pill pl-3 pr-3 mr-1"><i class="fa fa-pen"></i></button>
                        <button data-toggle="modal" data-target="#delete-afdelling{{ $key }}" class="btn btn-sm btn-outline-danger rounded-pill pl-3 pr-3"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <a href="{{ route('superadmin.company.farm.afdelling.blocks', $afdelling->id) }}">
                    <div class="card-body text-dark">
                        {{ ucwords($afdelling->name) }}
                    </div>
                    <div class="card-footer text-muted">
                        @if($afdelling->assistant)
                        <span class="badge badge-sm badge-light">assistant</span> {{ ucwords($afdelling->assistant) }}
                        @else
                        <div class="text-center">Belum ditentukan</div>
                        @endif
                    </div>
                </a>
            </div>
        </div>

        <!-- Modal edit afdelling -->
        <div class="modal fade" id="edit-afdelling{{ $key }}" tabindex="-1" aria-labelledby="edit-afdellingLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit-afdellingLabel">Perbarui data Afdelling</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('superadmin.afdelling.update', $afdelling->id) }}">
                            @method('PUT')
                            @csrf

                            <div class="form-group">
                                <label for="name">Farm</label>
                                <input class="form-control rounded-pill outline-danger" value="{{ ucwords($farm->name) }}" readonly>
                                <input type="hidden" name="farm_id" class="form-control" value="{{ $farm->id }}">
                            </div>

                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input name="afdelling" type="name" class="form-control rounded-pill outline-danger" value="{{ ucwords($afdelling->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">HK total</label>
                                <input name="hk_total" type="text" class="form-control rounded-pill outline-danger" value="{{ $afdelling->hk_total }}" required>
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

        <!-- Modal delete afdelling -->
        <div class="modal fade" id="delete-afdelling{{ $key }}" tabindex="-1" aria-labelledby="delete-afdellingLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delete-afdellingLabel">Hapus data Afdelling</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('superadmin.afdelling.delete', $afdelling->id) }}">
                            @method('DELETE')
                            @csrf
                            Yakin untuk menghapus Afdelling?

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
            <div class="text-muted text-center h6 mt-5">Afdelling Tidak Tersedia.</div>
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