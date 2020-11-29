@extends('layouts.app')

@section('title', 'Mandor 1')

@section('content-title')
Daftar Mandor 1
@endsection

@section('modal')

@endsection

@section('content')
<div class="row">
    <div class="col-8">
        <div class="card">
            <table class="table table-hover table-borderless">
                <thead class="text-muted">
                    <tr>
                        <th>#</th>
                        <th>Nama Mandor</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($foremans as $key => $foreman)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $foreman->name }}</td>
                        <td>{{ $foreman->email }}</td>
                        <td>
                            <button class="btn btn-sm rounded-pill btn-outline-info pl-3 pr-3" data-toggle="modal"
                                data-target="#edit-foreman{{$key}}"><i class="nav-icon fas fa-pen"></i>
                            </button>
                            <button class="btn btn-sm rounded-pill btn-outline-danger pl-3 pr-3" data-toggle="modal"
                                data-target="#delete-foreman{{$key}}"><i class="nav-icon fas fa-trash"></i>
                            </button>
                        </td>

                        <!-- Modal edit foreman -->
                        <div class="modal fade" id="edit-foreman{{$key}}" tabindex="-1"
                            aria-labelledby="edit-foremanLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit-foremanLabel">Edit foreman</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('foreman.update', ['foreman' => $foreman->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="foreman">Foreman-1</label>
                                                <input type="text" name="foreman" id="foreman" class="form-control"
                                                    required value="{{ $foreman->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    required value="{{ $foreman->email }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="afdelling_id">Afdelling</label>
                                                <select name="afdelling_id" id="afdelling_id" class="form-control">
                                                    @foreach($afdellings as $af)
                                                    <option
                                                        <?php if($af->id == $foreman->afdelling_id) echo "selected" ?>
                                                        value="{{ $af->id }}">{{ $af->name }}</option>
                                                    @endforeach
                                                </select>
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

                        <!-- Modal delete foreman -->
                        <div class="modal fade" id="delete-foreman{{$key}}" tabindex="-1"
                            aria-labelledby="delete-foremanLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delete-foremanLabel">Delete foreman</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('foreman.delete', ['foreman' => $foreman->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            Are you sure to delete selected foreman <b>"{{ $foreman->name }}"</b>?
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
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                Tambah Mandor 1
            </div>
            <div class="card-body">
                <form action="{{ route('foreman.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="foreman">Nama</label>
                        <input type="text" name="foreman" id="foreman" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="afdelling_id">Afdelling</label>
                        <select name="afdelling_id" id="afdelling_id" class="form-control">
                            @foreach($afdellings as $af)
                            <option value="{{ $af->id }}">{{ $af->name }}</option>
                            @endforeach
                        </select>
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
