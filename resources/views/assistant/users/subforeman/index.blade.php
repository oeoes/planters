@extends('assistant.layouts.app')

@section('title', 'PLANTERS - Mandor Bidang')

@section('content-title')
Daftar Mandor Bidang
@endsection

@section('modal')

@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <table id="myTable" class="table table-hover table-borderless table-responsive">
                <thead class="text-muted">
                    <tr>
                        <th>#</th>
                        <th>Nama Mandor</th>
                        <th>Email</th>
                        <th>Afdelling</th>
                        <th>Jenis Pekerjaan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subforemans as $key => $subforeman)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $subforeman->name }}</td>
                        <td>{{ $subforeman->email }}</td>
                        <td>{{ $subforeman->afdelling }}</td>
                        <td>{{ $subforeman->job_type }}</td>
                        <td>
                            <button class="btn btn-sm rounded-pill btn-outline-info pl-3 pr-3 mb-2" data-toggle="modal"
                                data-target="#edit-subforeman{{$key}}"><i class="nav-icon fas fa-pen"></i>
                            </button>
                            <button class="btn btn-sm rounded-pill btn-outline-danger pl-3 pr-3" data-toggle="modal"
                                data-target="#delete-subforeman{{$key}}"><i class="nav-icon fas fa-trash"></i>
                            </button>
                        </td>

                        <!-- Modal edit subforeman -->
                        <div class="modal fade" id="edit-subforeman{{$key}}" tabindex="-1"
                            aria-labelledby="edit-subforemanLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit-subforemanLabel">Edit Mandor Bidang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form
                                            action="{{ route('assistant.subforeman.update', ['subforeman' => $subforeman->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="jobtype_id">Job Type</label>
                                                <select name="jobtype_id" id="" class="form-control">
                                                    @foreach ($job_types as $jt)
                                                    <option <?php if($subforeman->afdelling_id == $jt->id) echo "selected" ?> value="{{ $jt->id }}">{{ $jt->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="subforeman">Nama</label>
                                                <input type="text" name="subforeman" id="subforeman"
                                                    class="form-control" required value="{{ $subforeman->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    required value="{{ $subforeman->email }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password"
                                                    class="form-control" required>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button"
                                            class="btn btn-sm rounded-pill btn-outline-secondary pl-3 pr-3"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit"
                                            class="btn btn-sm rounded-pill btn-outline-primary pl-3 pr-3">Save
                                            changes</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal delete subforeman -->
                        <div class="modal fade" id="delete-subforeman{{$key}}" tabindex="-1"
                            aria-labelledby="delete-subforemanLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delete-subforemanLabel">Delete subforeman</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form
                                            action="{{ route('assistant.subforeman.delete', ['subforeman' => $subforeman->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            Are you sure to delete selected subforeman <b>"{{ $subforeman->name }}"</b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button"
                                            class="btn btn-sm rounded-pill btn-outline-secondary pl-3 pr-3"
                                            data-dismiss="modal">Cancle</button>
                                        <button type="submit"
                                            class="btn btn-sm rounded-pill btn-outline-primary pl-3 pr-3">Yes</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Tambah Mandor Bidang
            </div>
            <div class="card-body">
                <form action="{{ route('assistant.subforeman.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="afdelling_id">Kebun</label>
                        <input type="text" class="form-control" value="{{ $farm_af->farm }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="afdelling_id">Afdelling</label>
                        <input type="text" class="form-control" value="{{ $farm_af->afdelling }}" readonly>
                        <input name="afdelling_id" type="hidden" class="form-control"
                            value="{{ $farm_af->afdelling_id }}">
                    </div>

                    <div class="form-group">
                        <label for="jobtype_id">Job Type</label>
                        <select name="jobtype_id" id="" class="form-control">
                            @foreach ($job_types as $jt)
                            <option value="{{ $jt->id }}">{{ $jt->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="subforeman">Nama</label>
                        <input type="text" name="subforeman" id="subforeman" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-sm rounded-pill btn-outline-primary pl-3 pr-3">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

</script>
@endsection
