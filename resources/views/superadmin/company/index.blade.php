@extends('superadmin.layouts.app')

@section('title', 'Daftar Perusahaan')

@section('page-title', 'Daftar Perusahaan')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Daftar Perusahaan</li>
    </ol>
</nav>
@endsection

@section('add-owner')
<div class="d-flex flex-row-reverse">
    <button class="btn btn-sm btn-outline-primary rounded-pill pl-3 pr-3 ml-1" data-toggle="modal" data-target="#add-company">PT <i class="fas fa-plus ml-1"></i> </button>

    <!-- Modal add pt -->
    <div class="modal fade" id="add-company" tabindex="-1" aria-labelledby="add-companyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-companyLabel">Tambah PT baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('superadmin.company.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Perusahaan</label>
                            <input name="company_name" class="form-control rounded-pill outline-danger">
                        </div>

                        <div class="form-group">
                            <label for="name">Kode Perusahaan</label>
                            <input name="company_code" class="form-control rounded-pill outline-danger">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill pr-4 pl-4" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill pr-4 pl-4">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('content')
    <div class="row mt-4">
        @if(count($companies))
        @foreach ($companies as $key => $company)
        <div class="col-md-3">
            <div id="wadah" class="card card-outline card-primary">
                <div class="crudd__btn_cont">
                    <div class="d-flex justify-content-center mt-2">
                        <button data-toggle="modal" data-target="#edit-company{{ $key }}" class="btn btn-sm btn-outline-primary rounded-pill pl-3 pr-3 mr-1"><i class="fa fa-pen"></i></button>
                        <button data-toggle="modal" data-target="#delete-company{{ $key }}" class="btn btn-sm btn-outline-danger rounded-pill pl-3 pr-3"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <a href="{{ route('superadmin.company.farm', $company->id) }}">
                    <div class="card-body text-dark">
                        <div class="row no-gutters">
                            <div class="col-9">{{ $company->company_name }}</div>
                            <div class="col-3 d-flex flex-row-reverse">
                                <div class="card rounded-pill bg-info" style="width: 50px; height: 50px"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">

                        @if($company->owner)
                        <span class="badge badge-sm badge-light">company owner</span> {{ ucwords($company->owner) }}
                        @else
                        <div class="text-center">Belum ditentukan</div>
                        @endif
                    </div>
                </a>
            </div>
        </div>

        <!-- Modal edit company -->
        <div class="modal fade" id="edit-company{{ $key }}" tabindex="-1" aria-labelledby="edit-companyLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit-companyLabel">Perbarui data PT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('superadmin.company.update', $company->id) }}">
                            @method('PUT')
                            @csrf

                            <div class="form-group">
                                <label for="name">Nama Perusahaan</label>
                                <input name="company_name" class="form-control rounded-pill outline-danger" value="{{ $company->company_name }}">
                            </div>

                            <div class="form-group">
                                <label for="name">Kode Perusahaan</label>
                                <input name="company_code" class="form-control rounded-pill outline-danger" value="{{ $company->company_code }}">
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

        <!-- Modal delete company -->
        <div class="modal fade" id="delete-company{{ $key }}" tabindex="-1" aria-labelledby="delete-companyLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delete-companyLabel">Hapus data PT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('superadmin.company.delete', $company->id) }}">
                            @method('DELETE')
                            @csrf
                            Yakin untuk menghapus PT?

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
            <div class="text-muted text-center h6 mt-5">Perusahaan Tidak Tersedia.</div>
        </div>
        @endif
    </div>
    @endsection

    @section('js')
    <script>
        ScrollReveal().reveal('.card', {
            delay: 500
        });
    </script>
    @endsection