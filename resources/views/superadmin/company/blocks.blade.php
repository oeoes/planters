@extends('superadmin.layouts.app')

@section('title', 'Daftar Block')
@section('page-title', 'Daftar Block')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('superadmin.company') }}">Daftar Perusahaan</a></li>
        <li class="breadcrumb-item"><a href="{{ route('superadmin.company.farm', $company->id) }}">{{ ucwords($company->company_name) }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('superadmin.company.farm.afdellings', $farm->id) }}">{{ ucwords($farm->name) }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ ucwords($afdelling->name) }}</li>
    </ol>
</nav>
@endsection

@section('add-owner')
<div class="d-flex flex-row-reverse">
    <button class="btn btn-sm btn-outline-secondary rounded-pill pl-3 pr-3 ml-1" data-toggle="modal" data-target="#add-block">Block <i class="fas fa-plus ml-1"></i> </button>
    @if($assistant)
    <button class="btn btn-sm btn-outline-info rounded-pill pl-3 pr-3">{{ ucwords($assistant->name) }} <i class="fas fa-user mr-1"></i> </button>
    @else
    <button class="btn btn-sm btn-outline-secondary rounded-pill pl-3 pr-3" data-toggle="modal" data-target="#add-assistant">Add Assistant Kebun <i class="fas fa-user mr-1"></i> </button>

    <!-- Modal add assistant -->
    <div class="modal fade" id="add-assistant" tabindex="-1" aria-labelledby="add-assistantLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-assistantLabel">Tambah assistant kebun pada afdelling ini</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('superadmin.user.assistant.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Farm</label>
                            <input class="form-control rounded-pill outline-danger" value="{{ ucwords($farm->name) }}" readonly>
                            <input type="hidden" name="farm_id" class="form-control" value="{{ $farm->id }}">
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

    <!-- Modal add Block -->
    <div class="modal fade" id="add-block" tabindex="-1" aria-labelledby="add-blockLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-blockLabel">Tambah data afdelling</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('superadmin.block.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Farm</label>
                            <input class="form-control rounded-pill outline-danger" value="{{ ucwords($farm->name) }}" readonly>
                            <input type="hidden" name="farm_id" class="form-control" value="{{ $farm->id }}">
                        </div>

                        <div class="form-group">
                            <label for="name">Afdelling</label>
                            <input class="form-control rounded-pill outline-danger" value="{{ ucwords($afdelling->name) }}" readonly>
                            <input type="hidden" name="afdelling_id" class="form-control" value="{{ $afdelling->id }}">
                        </div>

                        <div class="form-group">
                            <label for="name">Kode block</label>
                            <input name="block" type="name" class="form-control rounded-pill outline-danger" required>
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
        @if(count($blocks))
        @foreach ($blocks as $key => $block)
        <div class="col-md-3">
            <div id="wadah" class="card card-outline card-primary">
                <div class="crudd__btn_cont">
                    <div class="d-flex justify-content-center mt-2">
                        <button data-toggle="modal" data-target="#edit-block{{ $key }}" class="btn btn-sm btn-outline-primary rounded-pill pl-3 pr-3 mr-1"><i class="fa fa-pen"></i></button>
                        <button data-toggle="modal" data-target="#delete-block{{ $key }}" class="btn btn-sm btn-outline-danger rounded-pill pl-3 pr-3"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <a href="">
                    <div class="card-body text-dark">
                        {{ ucwords($block->code) }}
                    </div>
                    <div class="card-footer text-muted">
                        (some information)
                    </div>
                </a>
            </div>
        </div>

        <!-- Modal edit block -->
        <div class="modal fade" id="edit-block{{ $key }}" tabindex="-1" aria-labelledby="edit-blockLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit-blockLabel">Perbarui data Block</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('superadmin.block.update', $block->id) }}">
                            @method('PUT')
                            @csrf

                            <div class="form-group">
                                <label for="name">Farm</label>
                                <input class="form-control rounded-pill outline-danger" value="{{ ucwords($farm->name) }}" readonly>
                                <input type="hidden" name="farm_id" class="form-control" value="{{ $farm->id }}">
                            </div>

                            <div class="form-group">
                                <label for="name">Afdelling</label>
                                <input class="form-control rounded-pill outline-danger" value="{{ ucwords($afdelling->name) }}" readonly>
                                <input type="hidden" name="afdelling_id" class="form-control" value="{{ $afdelling->id }}">
                            </div>

                            <div class="form-group">
                                <label for="name">Kode block</label>
                                <input name="block" type="name" class="form-control rounded-pill outline-danger" value="{{ $block->code }}" required>
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

        <!-- Modal delete block -->
        <div class="modal fade" id="delete-block{{ $key }}" tabindex="-1" aria-labelledby="delete-blockLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delete-blockLabel">Hapus data Block</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('superadmin.block.delete', $block->id) }}">
                            @method('DELETE')
                            @csrf
                            Yakin untuk menghapus Block?

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
            <div class="text-muted text-center h6 mt-5">Block Tidak Tersedia.</div>
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