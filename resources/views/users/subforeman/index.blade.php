@extends('layouts.app')

@section('title', 'Mandor 2')

@section('content-title')
Daftar Mandor 2
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
                    @foreach ($foremans2 as $key => $foreman2)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $foreman2->name }}</td>
                        <td>{{ $foreman2->email }}</td>
                        <td>
                            <button class="btn btn-sm rounded-pill btn-outline-info pl-3 pr-3" data-toggle="modal"
                                data-target="#edit-foreman2{{$key}}"><i class="nav-icon fas fa-pen"></i>
                            </button>
                            <button class="btn btn-sm rounded-pill btn-outline-danger pl-3 pr-3" data-toggle="modal"
                                data-target="#delete-foreman2{{$key}}"><i class="nav-icon fas fa-trash"></i>
                            </button>
                        </td>

                        <!-- Modal edit foreman2 -->
                        <div class="modal fade" id="edit-foreman2{{$key}}" tabindex="-1"
                            aria-labelledby="edit-foreman2Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit-foreman2Label">Edit foreman2</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('foreman2.update', ['foreman2' => $foreman2->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="foreman2">Foreman-1</label>
                                                <input type="text" name="foreman2" id="foreman2" class="form-control"
                                                    required value="{{ $foreman2->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    required value="{{ $foreman2->email }}">
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

                        <!-- Modal delete foreman2 -->
                        <div class="modal fade" id="delete-foreman2{{$key}}" tabindex="-1"
                            aria-labelledby="delete-foreman2Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delete-foreman2Label">Delete foreman2</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('foreman2.delete', ['foreman2' => $foreman2->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            Are you sure to delete selected foreman2 <b>"{{ $foreman2->name }}"</b>?
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
                Tambah Mandor 2
            </div>
            <div class="card-body">
                <form action="{{ route('foreman2.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="foreman2">Nama</label>
                        <input type="text" name="foreman2" id="foreman2" class="form-control" required>
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
