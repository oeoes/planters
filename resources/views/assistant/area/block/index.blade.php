@extends('assistant.layouts.app')

@section('title', 'Block list')

@section('content-title')
Daftar Block
@endsection

@section('modal')

@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <table id="myTable" class="table table-hover table-borderless">
                <thead class="text-muted">
                    <tr>
                        <th>#</th>
                        <th>Block</th>
                        <th>Afdelling</th>
                        <th>Farm</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blocks as $key => $block)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $block->code }}</td>
                        <td>{{ $block->afdelling }}</td>
                        <td>{{ $block->farm }}</td>
                        <td>
                            <button class="btn btn-sm rounded-pill btn-outline-info pl-3 pr-3 mb-2" data-toggle="modal"
                                data-target="#edit-block{{$key}}"><i class="nav-icon fas fa-pen"></i>
                            </button>
                            <button class="btn btn-sm rounded-pill btn-outline-danger pl-3 pr-3" data-toggle="modal"
                                data-target="#delete-block{{$key}}"><i class="nav-icon fas fa-trash"></i>
                            </button>
                        </td>

                        <!-- Modal edit block -->
                        <div class="modal fade" id="edit-block{{$key}}" tabindex="-1" aria-labelledby="edit-blockLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit-blockLabel">Edit block</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('assistant.block.update', ['block' => $block->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="block">block</label>
                                                <input type="text" name="block" id="block" class="form-control"
                                                    value="{{ $block->code }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="afdelling">Afdelling</label>
                                                <select name="afdelling_id" id="afdelling" class="form-control">
                                                    
                                                </select>
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

                        <!-- Modal delete block -->
                        <div class="modal fade" id="delete-block{{$key}}" tabindex="-1"
                            aria-labelledby="delete-blockLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delete-blockLabel">Delete block</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('assistant.block.delete', ['block' => $block->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            Are you sure to delete selected block <b>"{{ $block->code }}"</b>?
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
                Add block
            </div>
            <div class="card-body">
                <form action="{{ route('assistant.block.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="block">Block</label>
                        <input type="text" name="block" id="block" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="afdelling">Afdelling</label>
                        <select name="afdelling_id" id="afdelling" class="form-control">
                            @foreach($afdellings as $af)
                            <option value="{{$af->id}}">{{ $af->name }}</option>
                            @endforeach
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
<script>

</script>
@endsection
