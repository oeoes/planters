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
    <button class="btn btn-sm btn-secondary rounded-pill ml-1 btn-hov" data-toggle="modal" data-target="#add-block"><span class="btn-hov-txt">Block</span> <i class="fas fa-plus"></i> </button>
    <button class="btn btn-sm btn-primary rounded-pill ml-1 btn-hov" data-toggle="modal" data-target="#add-foreman"><span class="btn-hov-txt">Md. Utama</span> <i class="fas fa-user-plus"></i> </button>
    <button class="btn btn-sm btn-info rounded-pill ml-1 btn-hov" data-toggle="modal" data-target="#add-subforeman"><span class="btn-hov-txt">Md. Bidang</span> <i class="fas fa-user-plus"></i> </button>
    @if($assistant)
    <button class="btn btn-sm btn-outline-info rounded-pill pl-3 pr-3">{{ ucwords($assistant->name) }} <i class="fas fa-user"></i> </button>
    @else
    <button class="btn btn-sm btn-outline-secondary rounded-pill pl-3 pr-3" data-toggle="modal" data-target="#add-assistant">Assist. Kebun <i class="fas fa-user-plus"></i> </button>

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
                    <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill pr-4 pl-4">Tambah</button>
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
                    <h5 class="modal-title" id="add-blockLabel">Tambah data block</h5>
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

                        <div class="form-group">
                            <label for="name">Latitude</label>
                            <input name="lat" type="name" class="form-control rounded-pill outline-danger" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Longitude</label>
                            <input name="lng" type="name" class="form-control rounded-pill outline-danger" required>
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

    <!-- Modal add Foreman -->
    <div class="modal fade" id="add-foreman" tabindex="-1" aria-labelledby="add-foremanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-foremanLabel">Tambah Mandor 1</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('superadmin.foreman.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="foreman">Nama</label>
                            <input type="text" name="foreman" class="form-control rounded-pill rounded-pill" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control rounded-pill" required>
                        </div>

                        <div class="form-group">
                            <label for="afdelling_id">Afdelling</label>
                            <input type="text" class="form-control rounded-pill" value="{{ $afdelling->name }}" readonly>
                            <input type="hidden" name="afdelling_id" class="form-control rounded-pill" value="{{ $afdelling->id }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control rounded-pill" required>
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

    <!-- Modal add Sub foreman -->
    <div class="modal fade" id="add-subforeman" tabindex="-1" aria-labelledby="add-subforemanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-subforemanLabel">Tambah Mandor bidang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('superadmin.subforeman.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="foreman">Nama</label>
                            <input type="text" name="subforeman" class="form-control rounded-pill rounded-pill" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control rounded-pill" required>
                        </div>

                        <div class="form-group">
                            <label for="afdelling_id">Afdelling</label>
                            <input type="text" class="form-control rounded-pill" value="{{ $afdelling->name }}" readonly>
                            <input type="hidden" name="afdelling_id" class="form-control rounded-pill" value="{{ $afdelling->id }}">
                        </div>

                        <div class="form-group">
                            <label>Jenis Pekerjaan</label>
                            <select name="jobtype_id" class="form-control rounded-pill">
                                @foreach ($jobtypes as $jt)
                                <option value="{{ $jt->id }}">{{ $jt->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control rounded-pill" required>
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
        @if(count($blocks))
        <div class="col-md-9">
            <div class="row">
                @foreach ($blocks as $key => $block)
                <div class="col-md-4">
                    <div id="wadah" class="card card-outline card-secondary">
                        <div class="crudd__btn_cont">
                            <div class="d-flex justify-content-center mt-2">
                                <button data-toggle="modal" data-target="#edit-block{{ $key }}" class="btn btn-sm btn-outline-primary rounded-pill pl-3 pr-3 mr-1"><i class="fa fa-pen"></i></button>
                                <button data-toggle="modal" data-target="#delete-block{{ $key }}" class="btn btn-sm btn-outline-danger rounded-pill pl-3 pr-3"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <a>
                            <div class="card-body text-dark">
                                Block {{ ucwords($block->code) }}
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

                                    <div class="form-group">
                                        <label for="name">Latitude</label>
                                        <input name="lat" type="name" class="form-control rounded-pill outline-danger" value="{{ $block->lat }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Longitude</label>
                                        <input name="lng" type="name" class="form-control rounded-pill outline-danger" value="{{ $block->lng }}" required>
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
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Data Mandor pada Afdelling
                </div>
                <div class="card-body">
                    <div><span class="badge badge-sm badge-light">Mandor utama</span></div>
                    <ol style="list-style-type: circle">
                        @forelse ($foremans as $key => $foreman)
                        <li>{{ $foreman->name }} <span class="badge badge-sm badge-primary" data-toggle="modal" data-target="#edit-foreman{{ $key }}"><i class="fa fa-pen"></i></span> <span class="badge badge-sm badge-danger" data-toggle="modal" data-target="#delete-foreman{{ $key }}"><i class="fa fa-trash"></i></span></li>

                        <!-- Modal edit Foreman -->
                        <div class="modal fade" id="edit-foreman{{ $key }}" tabindex="-1" aria-labelledby="edit-foremanLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit-foremanLabel">Edit Mandor 1</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('superadmin.foreman.update', ['foreman' => $foreman->id]) }}">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-group">
                                                <label for="foreman">Nama</label>
                                                <input type="text" name="foreman" class="form-control rounded-pill rounded-pill" required value="{{ $foreman->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control rounded-pill" required value="{{ $foreman->email }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="afdelling_id">Afdelling</label>
                                                <input type="text" class="form-control rounded-pill" value="{{ $afdelling->name }}" readonly>
                                                <input type="hidden" name="afdelling_id" class="form-control rounded-pill" value="{{ $afdelling->id }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" class="form-control rounded-pill" placeholder="Kosongkan bila tidak mengubah password">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill pr-4 pl-4" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill pr-4 pl-4">Perbarui</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal delete Foreman -->
                        <div class="modal fade" id="delete-foreman{{ $key }}" tabindex="-1" aria-labelledby="delete-foremanLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delete-foremanLabel">Hapus Mandor utama</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('superadmin.foreman.delete', ['foreman' => $foreman->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            Yakin untuk menghapus Mandor utama?

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill pr-4 pl-4" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill pr-4 pl-4">Ya</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <small class="text-muted">Mandor tidak tersedia.</small>
                        @endforelse
                    </ol>

                    <div><span class="badge badge-sm badge-light">Mandor Bidang</span></div>
                    <ol style="list-style-type: circle">
                        <li id="spraying-parent"><a href="">Spraying ({{ count($sprayings) }})</a></li>
                        <ol id="spraying-children" style="list-style-type: decimal">
                            @foreach($sprayings as $key => $sp)
                            <li>{{ $sp->name }} <span class="badge badge-sm badge-primary" data-toggle="modal" data-target="#edit-spraying{{ $key }}"><i class="fa fa-pen"></i></span> <span class="badge badge-sm badge-danger" data-toggle="modal" data-target="#delete-spraying{{ $key }}"><i class="fa fa-trash"></i></span></li>

                            <!-- Modal edit Sub foreman -->
                            <div class="modal fade" id="edit-spraying{{$key}}" tabindex="-1" aria-labelledby="edit-sprayingLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="edit-sprayingLabel">Edit Mandor bidang (Spraying)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('superadmin.subforeman.update', ['subforeman' => $sp->id]) }}">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <label for="foreman">Nama</label>
                                                    <input type="text" name="subforeman" class="form-control rounded-pill rounded-pill" required value="{{ $sp->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" class="form-control rounded-pill" required value="{{ $sp->email }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Jenis Pekerjaan</label>
                                                    <select name="jobtype_id" class="form-control rounded-pill">
                                                        @foreach ($jobtypes as $jt)
                                                        <option <?php $sp->jobtype_id === $jt->id ? print 'selected' : '' ?> value="{{ $jt->id }}">{{ $jt->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" class="form-control rounded-pill" placeholder="Kosongkan bila tidak mengubah password">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill pr-4 pl-4" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill pr-4 pl-4">Perbarui</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal delete Sub foreman -->
                            <div class="modal fade" id="delete-spraying{{ $key }}" tabindex="-1" aria-labelledby="delete-sprayingLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="delete-sprayingLabel">Hapus Mandor Bidang (Spraying)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('superadmin.subforeman.delete', ['subforeman' => $sp->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                Yakin untuk menghapus Mandor Bidang?

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
                        </ol>
                        <li id="fertilizer-parent"><a href="">Fertilizer ({{ count($fertilizers) }})</a></li>
                        <ol id="fertilizer-children" style="list-style-type: decimal">
                            @foreach($fertilizers as $key => $fz)
                            <li>{{ $fz->name }} <span class="badge badge-sm badge-primary" data-toggle="modal" data-target="#edit-fertilizer{{ $key }}"><i class="fa fa-pen"></i></span> <span class="badge badge-sm badge-danger" data-toggle="modal" data-target="#delete-fertilizer{{ $key }}"><i class="fa fa-trash"></i></span></li>

                            <!-- Modal edit Sub foreman -->
                            <div class="modal fade" id="edit-fertilizer{{ $key }}" tabindex="-1" aria-labelledby="edit-fertilizerLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="edit-sprayingLabel">Edit Mandor bidang (Fertilizer)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('superadmin.subforeman.update', ['subforeman' => $fz->id]) }}">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <label for="foreman">Nama</label>
                                                    <input type="text" name="subforeman" class="form-control rounded-pill rounded-pill" required value="{{ $fz->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" class="form-control rounded-pill" required value="{{ $fz->email }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Jenis Pekerjaan</label>
                                                    <select name="jobtype_id" class="form-control rounded-pill">
                                                        @foreach ($jobtypes as $jt)
                                                        <option <?php $fz->jobtype_id === $jt->id ? print 'selected' : '' ?> value="{{ $jt->id }}">{{ $jt->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" class="form-control rounded-pill" placeholder="Kosongkan bila tidak mengubah password">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill pr-4 pl-4" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill pr-4 pl-4">Perbarui</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal delete Sub foreman -->
                            <div class="modal fade" id="delete-fertilizer{{ $key }}" tabindex="-1" aria-labelledby="delete-fertilizerLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="delete-sprayingLabel">Hapus Mandor Bidang (Fertilizer)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('superadmin.subforeman.delete', ['subforeman' => $fz->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                Yakin untuk menghapus Mandor Bidang?

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
                        </ol>
                        <li id="circle-parent"><a href="">Manual Circle ({{ count($circles) }})</a></li>
                        <ol id="circle-children" style="list-style-type: decimal">
                            @foreach($circles as $key => $cs)
                            <li>{{ $cs->name }} <span class="badge badge-sm badge-primary" data-toggle="modal" data-target="#edit-circle{{ $key }}"><i class="fa fa-pen"></i></span> <span class="badge badge-sm badge-danger" data-toggle="modal" data-target="#delete-circle{{ $key }}"><i class="fa fa-trash"></i></span></li>

                            <!-- Modal edit Sub foreman -->
                            <div class="modal fade" id="edit-circle{{ $key }}" tabindex="-1" aria-labelledby="edit-circleLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="edit-sprayingLabel">Edit Mandor bidang (circle)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('superadmin.subforeman.update', ['subforeman' => $cs->id]) }}">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <label for="foreman">Nama</label>
                                                    <input type="text" name="subforeman" class="form-control rounded-pill rounded-pill" required value="{{ $cs->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" class="form-control rounded-pill" required value="{{ $cs->email }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Jenis Pekerjaan</label>
                                                    <select name="jobtype_id" class="form-control rounded-pill">
                                                        @foreach ($jobtypes as $jt)
                                                        <option <?php $cs->jobtype_id === $jt->id ? print 'selected' : '' ?> value="{{ $jt->id }}">{{ $jt->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" class="form-control rounded-pill" placeholder="Kosongkan bila tidak mengubah password">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill pr-4 pl-4" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill pr-4 pl-4">Perbarui</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal delete Sub foreman -->
                            <div class="modal fade" id="delete-circle{{ $key }}" tabindex="-1" aria-labelledby="delete-circleLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="delete-sprayingLabel">Hapus Mandor Bidang (circle)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('superadmin.subforeman.delete', ['subforeman' => $cs->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                Yakin untuk menghapus Mandor Bidang?

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
                        </ol>
                        <li id="pruning-parent"><a href="">Manual Pruning ({{ count($prunings) }})</a></li>
                        <ol id="pruning-children" style="list-style-type: decimal">
                            @foreach($prunings as $key => $pr)
                            <li>{{ $pr->name }} <span class="badge badge-sm badge-primary" data-toggle="modal" data-target="#edit-pruning{{ $key }}"><i class="fa fa-pen"></i></span> <span class="badge badge-sm badge-danger" data-toggle="modal" data-target="#delete-pruning{{ $key }}"><i class="fa fa-trash"></i></span></li>

                            <!-- Modal edit Sub foreman -->
                            <div class="modal fade" id="edit-pruning{{ $key }}" tabindex="-1" aria-labelledby="edit-pruningLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="edit-sprayingLabel">Edit Mandor bidang (pruning)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('superadmin.subforeman.update', ['subforeman' => $pr->id]) }}">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <label for="foreman">Nama</label>
                                                    <input type="text" name="subforeman" class="form-control rounded-pill rounded-pill" required value="{{ $pr->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" class="form-control rounded-pill" required value="{{ $pr->email }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Jenis Pekerjaan</label>
                                                    <select name="jobtype_id" class="form-control rounded-pill">
                                                        @foreach ($jobtypes as $jt)
                                                        <option <?php $pr->jobtype_id === $jt->id ? print 'selected' : '' ?> value="{{ $jt->id }}">{{ $jt->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" class="form-control rounded-pill" placeholder="Kosongkan bila tidak mengubah password">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill pr-4 pl-4" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill pr-4 pl-4">Perbarui</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal delete Sub foreman -->
                            <div class="modal fade" id="delete-pruning{{ $key }}" tabindex="-1" aria-labelledby="delete-pruningLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="delete-sprayingLabel">Hapus Mandor Bidang (pruning)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('superadmin.subforeman.delete', ['subforeman' => $pr->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                Yakin untuk menghapus Mandor Bidang?

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
                        </ol>
                        <li id="gawangan-parent"><a href="">Manual Gawangan ({{ count($gawangans) }})</a></li>
                        <ol id="gawangan-children" style="list-style-type: decimal">
                            @foreach($gawangans as $key => $gw)
                            <li>{{ $gw->name }} <span class="badge badge-sm badge-primary" data-toggle="modal" data-target="#edit-gawangan{{ $key }}"><i class="fa fa-pen"></i></span> <span class="badge badge-sm badge-danger" data-toggle="modal" data-target="#delete-gawangan{{ $key }}"><i class="fa fa-trash"></i></span></li>

                            <!-- Modal edit Sub foreman -->
                            <div class="modal fade" id="edit-gawangan{{ $key }}" tabindex="-1" aria-labelledby="edit-gawanganLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="edit-sprayingLabel">Edit Mandor bidang (gawangan)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('superadmin.subforeman.update', ['subforeman' => $gw->id]) }}">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <label for="foreman">Nama</label>
                                                    <input type="text" name="subforeman" class="form-control rounded-pill rounded-pill" required value="{{ $gw->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" class="form-control rounded-pill" required value="{{ $gw->email }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Jenis Pekerjaan</label>
                                                    <select name="jobtype_id" class="form-control rounded-pill">
                                                        @foreach ($jobtypes as $jt)
                                                        <option <?php $gw->jobtype_id === $jt->id ? print 'selected' : '' ?> value="{{ $jt->id }}">{{ $jt->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" class="form-control rounded-pill" placeholder="Kosongkan bila tidak mengubah password">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill pr-4 pl-4" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill pr-4 pl-4">Perbarui</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal delete Sub foreman -->
                            <div class="modal fade" id="delete-gawangan{{ $key }}" tabindex="-1" aria-labelledby="delete-gawanganLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="delete-sprayingLabel">Hapus Mandor Bidang (gawangan)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('superadmin.subforeman.delete', ['subforeman' => $gw->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                Yakin untuk menghapus Mandor Bidang?

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
                        </ol>
                        <li id="pcontrol-parent"><a href="">Pest Control ({{ count($pcontrols) }})</a></li>
                        <ol id="pcontrol-children" style="list-style-type: decimal">
                            @foreach($pcontrols as $key => $pc)
                            <li>{{ $pc->name }} <span class="badge badge-sm badge-primary" data-toggle="modal" data-target="#edit-pcontrol{{ $key }}"><i class="fa fa-pen"></i></span> <span class="badge badge-sm badge-danger" data-toggle="modal" data-target="#delete-pcontrol{{ $key }}"><i class="fa fa-trash"></i></span></li>

                            <!-- Modal edit Sub foreman -->
                            <div class="modal fade" id="edit-pcontrol{{ $key }}" tabindex="-1" aria-labelledby="edit-pcontrolLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="edit-sprayingLabel">Edit Mandor bidang (pcontrol)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('superadmin.subforeman.update', ['subforeman' => $pc->id]) }}">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <label for="foreman">Nama</label>
                                                    <input type="text" name="subforeman" class="form-control rounded-pill rounded-pill" required value="{{ $pc->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" class="form-control rounded-pill" required value="{{ $pc->email }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Jenis Pekerjaan</label>
                                                    <select name="jobtype_id" class="form-control rounded-pill">
                                                        @foreach ($jobtypes as $jt)
                                                        <option <?php $pc->jobtype_id === $jt->id ? print 'selected' : '' ?> value="{{ $jt->id }}">{{ $jt->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" class="form-control rounded-pill" placeholder="Kosongkan bila tidak mengubah password">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill pr-4 pl-4" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill pr-4 pl-4">Perbarui</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal delete Sub foreman -->
                            <div class="modal fade" id="delete-pcontrol{{ $key }}" tabindex="-1" aria-labelledby="delete-pcontrolLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="delete-sprayingLabel">Hapus Mandor Bidang (pcontrol)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('superadmin.subforeman.delete', ['subforeman' => $pc->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                Yakin untuk menghapus Mandor Bidang?

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
                        </ol>
                        <li id="harvesting-parent"><a href="">Harvesting ({{ count($harvestings) }})</a></li>
                        <ol id="harvesting-children" style="list-style-type: decimal">
                            @foreach($harvestings as $key => $hv)
                            <li>{{ $hv->name }} <span class="badge badge-sm badge-primary" data-toggle="modal" data-target="#edit-harvesting{{ $key }}"><i class="fa fa-pen"></i></span> <span class="badge badge-sm badge-danger" data-toggle="modal" data-target="#delete-harvesting{{ $key }}"><i class="fa fa-trash"></i></span></li>

                            <!-- Modal edit Sub foreman -->
                            <div class="modal fade" id="edit-harvesting{{ $key }}" tabindex="-1" aria-labelledby="edit-harvestingLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="edit-sprayingLabel">Edit Mandor bidang (harvesting)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('superadmin.subforeman.update', ['subforeman' => $hv->id]) }}">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <label for="foreman">Nama</label>
                                                    <input type="text" name="subforeman" class="form-control rounded-pill rounded-pill" required value="{{ $hv->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" class="form-control rounded-pill" required value="{{ $hv->email }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Jenis Pekerjaan</label>
                                                    <select name="jobtype_id" class="form-control rounded-pill">
                                                        @foreach ($jobtypes as $jt)
                                                        <option <?php $hv->jobtype_id === $jt->id ? print 'selected' : '' ?> value="{{ $jt->id }}">{{ $jt->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" class="form-control rounded-pill" placeholder="Kosongkan bila tidak mengubah password">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill pr-4 pl-4" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill pr-4 pl-4">Perbarui</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal delete Sub foreman -->
                            <div class="modal fade" id="delete-harvesting{{ $key }}" tabindex="-1" aria-labelledby="delete-harvestingLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="delete-sprayingLabel">Hapus Mandor Bidang (harvesting)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('superadmin.subforeman.delete', ['subforeman' => $hv->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                Yakin untuk menghapus Mandor Bidang?

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
                        </ol>
                    </ol>
                </div>
            </div>
        </div>

        @else
        <div class="col-md-4 offset-md-4 mt-5">
            <div class="text-muted text-center h6 mt-5">Block Tidak Tersedia.</div>
        </div>
        @endif
    </div>
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

    $(document).ready(function() {
        $('#spraying-children').css({
            'display': 'none',
        })

        $('#spraying-parent').click(function(e) {
            e.preventDefault()
            $('#spraying-children').toggle()
        })

        $('#fertilizer-children').css({
            'display': 'none',
        })

        $('#fertilizer-parent').click(function(e) {
            e.preventDefault()
            $('#fertilizer-children').toggle()
        })

        $('#circle-children').css({
            'display': 'none',
        })

        $('#circle-parent').click(function(e) {
            e.preventDefault()
            $('#circle-children').toggle()
        })

        $('#pruning-children').css({
            'display': 'none',
        })

        $('#pruning-parent').click(function(e) {
            e.preventDefault()
            $('#pruning-children').toggle()
        })

        $('#gawangan-children').css({
            'display': 'none',
        })

        $('#gawangan-parent').click(function(e) {
            e.preventDefault()
            $('#gawangan-children').toggle()
        })

        $('#pcontrol-children').css({
            'display': 'none',
        })

        $('#pcontrol-parent').click(function(e) {
            e.preventDefault()
            $('#pcontrol-children').toggle()
        })

        $('#harvesting-children').css({
            'display': 'none',
        })

        $('#harvesting-parent').click(function(e) {
            e.preventDefault()
            $('#harvesting-children').toggle()
        })
    })
</script>
@endsection