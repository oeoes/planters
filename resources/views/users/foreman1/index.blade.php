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
                    @foreach ($foremans1 as $key => $foreman1)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $foreman1->name }}</td>
                        <td>{{ $foreman1->email }}</td>
                        <td>
                            <button class="btn btn-sm rounded-pill btn-outline-info pl-3 pr-3" data-toggle="modal"
                                data-target="#edit-foreman1{{$key}}"><i class="nav-icon fas fa-pen"></i>
                            </button>
                            <button class="btn btn-sm rounded-pill btn-outline-danger pl-3 pr-3" data-toggle="modal"
                                data-target="#delete-foreman1{{$key}}"><i class="nav-icon fas fa-trash"></i>
                            </button>
                        </td>

                        <!-- Modal edit foreman1 -->
                        <div class="modal fade" id="edit-foreman1{{$key}}" tabindex="-1"
                            aria-labelledby="edit-foreman1Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit-foreman1Label">Edit foreman1</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('foreman1.update', ['foreman1' => $foreman1->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="foreman1">Foreman-1</label>
                                                <input type="text" name="foreman1" id="foreman1" class="form-control"
                                                    required value="{{ $foreman1->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    required value="{{ $foreman1->email }}">
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

                        <!-- Modal delete foreman1 -->
                        <div class="modal fade" id="delete-foreman1{{$key}}" tabindex="-1"
                            aria-labelledby="delete-foreman1Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delete-foreman1Label">Delete foreman1</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('foreman1.delete', ['foreman1' => $foreman1->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            Are you sure to delete selected foreman1 <b>"{{ $foreman1->name }}"</b>?
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
                <form action="{{ route('foreman1.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="foreman1">Nama</label>
                        <input type="text" name="foreman1" id="foreman1" class="form-control" required>
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
