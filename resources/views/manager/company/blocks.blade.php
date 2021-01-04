@extends('manager.layouts.app')

@section('title', 'Daftar Block')
@section('page-title', 'Daftar Block')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><strong>{{ $company->company_name }}</strong></li>
        <li class="breadcrumb-item"><a href="{{ route('manager.farm.afdellings', $farm->id) }}">{{ ucwords($farm->name) }}</a></li>
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
                    <form method="post" action="{{ route('manager.user.assistant.store') }}">
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
                    <form method="post" action="{{ route('manager.block.store') }}">
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
                    <form method="post" action="{{ route('manager.foreman.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="foreman">Nama</label>
                            <input type="text" name="foreman" id="foreman" class="form-control rounded-pill rounded-pill" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control rounded-pill" required>
                        </div>

                        <div class="form-group">
                            <label for="afdelling_id">Afdelling</label>
                            <input type="text" class="form-control rounded-pill" value="{{ $afdelling->name }}" readonly>
                            <input type="hidden" name="afdelling_id" class="form-control rounded-pill" value="{{ $afdelling->id }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control rounded-pill" required>
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
                    <form method="post" action="{{ route('manager.subforeman.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="foreman">Nama</label>
                            <input type="text" name="subforeman" id="foreman" class="form-control rounded-pill rounded-pill" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control rounded-pill" required>
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
                            <input type="password" name="password" id="password" class="form-control rounded-pill" required>
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
                            <form method="post" action="{{ route('manager.block.update', $block->id) }}">
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
                            <form method="post" action="{{ route('manager.block.delete', $block->id) }}">
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
                @if(count($foremans))
                <ol style="list-style-type: circle">
                    @foreach ($foremans as $key => $foreman)
                    <li>{{ $foreman->name }}</li>
                    @endforeach
                </ol>
                @else
                <small class="text-muted">Mandor tidak tersedia.</small>
                @endif

                <div><span class="badge badge-sm badge-light">Mandor Bidang</span></div>
                <ol style="list-style-type: circle">
                    <li id="spraying-parent"><a href="">Spraying ({{ count($sprayings) }})</a></li>
                    <ol id="spraying-children" style="list-style-type: decimal">
                        @foreach($sprayings as $key => $sp)
                        <li>{{ $sp->name }}</li>
                        @endforeach
                    </ol>
                    <li id="fertilizer-parent"><a href="">Fertilizer ({{ count($fertilizers) }})</a></li>
                    <ol id="fertilizer-children" style="list-style-type: decimal">
                        @foreach($fertilizers as $fz)
                        <li>{{ $fz->name }}</li>
                        @endforeach
                    </ol>
                    <li id="circle-parent"><a href="">Manual Circle ({{ count($circles) }})</a></li>
                    <ol id="circle-children" style="list-style-type: decimal">
                        @foreach($circles as $cs)
                        <li>{{ $cs->name }}</li>
                        @endforeach
                    </ol>
                    <li id="pruning-parent"><a href="">Manual Pruning ({{ count($prunings) }})</a></li>
                    <ol id="pruning-children" style="list-style-type: decimal">
                        @foreach($prunings as $pr)
                        <li>{{ $pr->name }}</li>
                        @endforeach
                    </ol>
                    <li id="gawangan-parent"><a href="">Manual Gawangan ({{ count($gawangans) }})</a></li>
                    <ol id="gawangan-children" style="list-style-type: decimal">
                        @foreach($gawangans as $gw)
                        <li>{{ $gw->name }}</li>
                        @endforeach
                    </ol>
                    <li id="pcontrol-parent"><a href="">Pest Control ({{ count($pcontrols) }})</a></li>
                    <ol id="pcontrol-children" style="list-style-type: decimal">
                        @foreach($pcontrols as $key => $subforeman)
                        <li>{{ $subforeman->name }}</li>
                        @endforeach
                    </ol>
                    <li id="harvesting-parent"><a href="">Harvesting ({{ count($harvestings) }})</a></li>
                    <ol id="harvesting-children" style="list-style-type: decimal">
                        @foreach($harvestings as $hv)
                        <li>{{ $hv->name }}</li>
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