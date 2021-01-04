@extends('superadmin.layouts.app')

@section('title', 'Assistant')

@section('content-title')
Daftar Assistant
@endsection

@section('modal')

@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card table-responsive">
            <table id="myTable" class="table table-hover table-borderless">
                <thead class="text-muted">
                    <tr>
                        <th>#</th>
                        <th>Assistant</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assistants as $key => $assistant)
                    <tr>
                        <td scope="row">{{ $key+1 }}</td>
                        <td>{{ $assistant->name }}</td>
                        <td>{{ $assistant->email }}</td>
                        <td>
                            <button class="btn btn-sm rounded-pill btn-outline-info pl-3 pr-3" data-toggle="modal"
                                data-target="#edit-assistant{{$key}}"><i class="nav-icon fas fa-pen"></i>
                            </button>
                            <div class="mb-1"></div>
                            <button class="btn btn-sm rounded-pill btn-outline-danger pl-3 pr-3" data-toggle="modal"
                                data-target="#delete-assistant{{$key}}"><i class="nav-icon fas fa-trash"></i>
                            </button>
                        </td>

                        <!-- Modal edit foreman -->
                        <div class="modal fade" id="edit-assistant{{$key}}" tabindex="-1"
                            aria-labelledby="edit-assistantLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit-assistantLabel">Edit Mandor</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            @csrf
                                            @method('PUT')

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button"
                                            class="btn btn-sm rounded-pill btn-outline-secondary pl-3 pr-3"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit"
                                            class="btn btn-sm rounded-pill btn-outline-primary pl-3 pr-3">Save
                                            changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal delete foreman -->
                        <div class="modal fade" id="delete-assistant{{$key}}" tabindex="-1"
                            aria-labelledby="delete-assistantLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delete-assistantLabel">Delete Mandor</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            @csrf
                                            @method('DELETE')
                                            Are you sure to delete selected foreman <b>""</b>?
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
                Tambah Assistant Kebun
            </div>
            <div class="card-body">
                <form action="{{ route('superadmin.user.assistant.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="farm">Farm</label>
                        <select name="farm" id="farm_id" class="form-control">
                            <option>Pilih Kebun</option>
                            @foreach ($farms as $f)
                            <option value="{{ $f->id }}">{{ $f->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="afdelling">Afdelling</label>
                        <select name="afdelling_id" id="store_afdelling" class="form-control">

                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm rounded-pill btn-outline-primary pl-3 pr-3">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    $(document).ready(function () {
        $(document).on('change', '#farm_id', function () {
            $('#store_afdelling').children().remove()
            axios.get(`/afdelling/list/${$('#farm_id').val()}`)
                .then(function (response) {
                    response.data.afdellings.forEach(function (e) {
                        $('#store_afdelling').append(`
                    <option value="${e.id}">${e.name}</option>
                `)
                    })
                })
        })
    });
</script>
@endsection
