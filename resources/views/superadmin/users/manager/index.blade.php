@extends('superadmin.layouts.app')

@section('title', 'Super Admin - Manager Kebun')

@section('content-title')
Daftar Manager Kebun
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($managers as $key => $manager)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $manager->name }}</td>
                        <td>{{ $manager->email }}</td>
                        <td>
                            <div class="mb-1"></div>
                            <button class="btn btn-sm rounded-pill btn-outline-danger pl-3 pr-3" data-toggle="modal"
                                data-target="#delete-manager{{$key}}"><i class="nav-icon fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Modal delete manager -->
                    <div class="modal fade" id="delete-manager{{$key}}" tabindex="-1"
                        aria-labelledby="delete-managerLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="delete-managerLabel">Delete Mandor</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('superadmin.user.manager.destroy', ['manager_id' => $manager->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        Are you sure to delete selected manager <b>"{{ $manager->name }}"</b>?
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Add Manager Kebun
            </div>
            <div class="card-body">
                <form action="{{ route('superadmin.user.manager.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="afdelling">Name</label>
                        <input type="text" name="name" id="afdelling" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="afdelling">Email</label>
                        <input type="email" name="email" id="afdelling" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="afdelling">Password</label>
                        <input type="password" name="password" id="afdelling" class="form-control">
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
