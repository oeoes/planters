@extends('layouts.app')

@section('title', 'Block References')

@section('content-title')
Daftar Referensi Block
@endsection

@section('modal')

@endsection

@section('content')
<div class="row">
    <div class="col-8">
        <div class="card">
            <table class="table table-hover table-borderless table-responsive">
                <thead class="text-muted">
                    <tr>
                        <th>#</th>
                        <th>Mandor</th>
                        <th>Block</th>
                        <th>Afdelling</th>
                        <th>Farm</th>
                        <th>Job type</th>
                        <th>Thn. Tanam</th>
                        <th>Tot. Cov</th>
                        <th>Av. Cov</th>
                        <th>Pop. Cov</th>
                        <th>Pop. Perblock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($block_references as $key => $block_reference)
                    <tr>
                        <td scope="row">{{ $key+1 }}</td>
                        <td>{{ $block_reference->foreman }}</td>
                        <td>{{ $block_reference->code }}</td>
                        <td>{{ $block_reference->afdelling }}</td>
                        <td>{{ $block_reference->farm }}</td>
                        <td>{{ $block_reference->job_type }}</td>
                        <td>{{ $block_reference->planting_year }}</td>
                        <td>{{ $block_reference->total_coverage }}</td>
                        <td>{{ $block_reference->available_coverage }}</td>
                        <td>{{ $block_reference->population_coverage }}</td>
                        <td>{{ $block_reference->population_perblock }}</td>
                        <td>
                            <button class="btn btn-sm rounded-pill btn-outline-info pl-3 pr-3 mb-1" data-toggle="modal"
                                data-target="#edit-block_reference{{$key}}"><i class="nav-icon fas fa-pen"></i>
                            </button>
                            <button class="btn btn-sm rounded-pill btn-outline-danger pl-3 pr-3" data-toggle="modal"
                                data-target="#delete-block_reference{{$key}}"><i class="nav-icon fas fa-trash"></i>
                            </button>
                        </td>

                        <!-- Modal edit block_reference -->
                        <div class="modal fade" id="edit-block_reference{{$key}}" tabindex="-1"
                            aria-labelledby="edit-block_referenceLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit-block_referenceLabel">Edit block reference</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form
                                            action="{{ route('block_reference.update', ['block_reference' => $block_reference->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="foreman_id">Mandor</label>
                                                <select name="foreman_id" id="foreman_id" class="form-control">
                                                    @foreach($foremans as $f)
                                                    <option <?php if($f->id == $block_reference->foreman_id) echo "selected" ?> value="{{ $f->id }}">{{ $f->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="block_id">Block</label>
                                                <select name="block_id" id="block_id" class="form-control">
                                                    @foreach($blocks as $b)
                                                    <option <?php if($b->id == $block_reference->block_id) echo "selected" ?> value="{{ $b->id }}">{{ $b->code }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="jobtype_id">Jenis Pekerjaan</label>
                                                <select name="jobtype_id" id="jobtype_id" class="form-control">
                                                    @foreach($job_types as $jt)
                                                    <option <?php if($jt->id == $block_reference->jobtype_id) echo "selected" ?> value="{{ $jt->id }}">{{ $jt->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="planting_year">Tahun Tanam</label>
                                                <input type="number" step="any" name="planting_year" id="planting_year" value="{{ $block_reference->planting_year }}"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="total_coverage">Total Coverage</label>
                                                <input type="number" step="any" name="total_coverage" id="total_coverage" value="{{ $block_reference->total_coverage }}"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="available_coverage">Available Coverage</label>
                                                <input type="number" step="any" name="available_coverage" id="available_coverage" value="{{ $block_reference->available_coverage }}"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="population_coverage">Population Coverage</label>
                                                <input type="number" step="any" name="population_coverage" id="population_coverage" value="{{ $block_reference->population_coverage }}"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="population_perblock">Population Perblock</label>
                                                <input type="number" step="any" name="population_perblock" id="population_perblock" value="{{ $block_reference->population_perblock }}"
                                                    class="form-control">
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
                        <div class="modal fade" id="delete-block_reference{{$key}}" tabindex="-1"
                            aria-labelledby="delete-block_referenceLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delete-block_referenceLabel">Delete block</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form
                                            action="{{ route('block_reference.delete', ['block_reference' => $block_reference->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            Are you sure to delete selected block reference?
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
                Add block
            </div>
            <div class="card-body">
                <form action="{{ route('block_reference.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="foreman_id">Mandor</label>
                        <select name="foreman_id" id="foreman_id" class="form-control">
                            @foreach($foremans as $f)
                            <option value="{{ $f->id }}">{{ $f->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="block_id">Block</label>
                        <select name="block_id" id="block_id" class="form-control">
                            @foreach($blocks as $b)
                            <option value="{{ $b->id }}">{{ $b->code }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jobtype_id">Jenis Pekerjaan</label>
                        <select name="jobtype_id" id="jobtype_id" class="form-control">
                            @foreach($job_types as $jt)
                            <option value="{{ $jt->id }}">{{ $jt->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="planting_year">Tahun Tanam</label>
                        <input type="number" step="any" name="planting_year" id="planting_year" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="total_coverage">Total Coverage</label>
                        <input type="number" step="any" name="total_coverage" id="total_coverage" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="available_coverage">Available Coverage</label>
                        <input type="number" step="any" name="available_coverage" id="available_coverage" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="population_coverage">Population Coverage</label>
                        <input type="number" step="any" name="population_coverage" id="population_coverage" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="population_perblock">Population Perblock</label>
                        <input type="number" step="any" name="population_perblock" id="population_perblock" class="form-control">
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
