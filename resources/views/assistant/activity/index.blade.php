@extends('assistant.layouts.app')

@section('title', 'Daftar Kelola Aktivitas')

@section('content-title')
    Daftar Kelola Aktivitas
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    Daftar kelola aktivitas
                    <span class="float-right">
                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                            data-target="#exampleModal">
                            <i class="fas fa-plus-circle    "></i>
                            aktivitas area
                        </button>
                    </span>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="bg-primary">
                            <tr>
                                <th>Blok</th>
                                <th>Tahun tanam</th>
                                <th>Luas area</th>
                                <th>Umur</th>
                                <th>Jumlah pokok</th>
                                <th>SPH</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($block_static as $key => $static)
                                <tr>
                                    <td>{{ block($static->block_id) }}</td>
                                    <td>{{ $static->planting_year }}</td>
                                    <td>{{ $static->total_coverage }}</td>
                                    <td>{{ date('Y') - $static->planting_year }}</td>
                                    <td>{{ $static->population_perblock }}</td>
                                    <td>{{ $static->population_coverage }}</td>
                                    <td>
                                        <button type="button" class="btn btn-default" data-toggle="modal"
                                            data-target="#modalEdit{{ $key }}">
                                            Edit
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="modalEdit{{ $key }}" tabindex="-1"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('assistant.activites.edit') }}" method="post"
                                                id="edtFrm">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="block">Blok</label>
                                                        <input type="hidden" name="block_id"
                                                            value="{{ $static->block_id }}">
                                                        <input type="text" name="block" id="block" class="form-control"
                                                            readonly value="{{ block($static->block_id) }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pyear">Tahun tanam</label>
                                                        <input type="text" name="pyear" id="pyear" class="form-control"
                                                            value="{{ $static->planting_year }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="totcov">Luas area</label>
                                                        <input type="text" name="mtcov" id="mtcov" class="form-control"
                                                            value="{{ $static->total_coverage }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="mpcov">SPH</label>
                                                        <input type="text" name="mpcov" id="mpcov" class="form-control"
                                                            value="{{ $static->population_coverage }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pblock">Jumlah pokok</label>
                                                        <input type="text" name="mpblock" id="mpblock" class="form-control"
                                                            value="{{ $static->population_perblock }}" readonly>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" form="edtFrm" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-dark">
                            <tr>
                                <td colspan="2" style="text-align:right">Total Ha:</td>
                                <td>{{ $total_coverage }}</td>
                                <td>{{ $total_ages }}</td>
                                <td>{{ $total_pblock }}</td>
                                <td>{{ $total_sph }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Bagan</div>
                <div class="card-body">
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah aktivitas area`</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('assistant.activities') }}" id="create_activity_area">
                        @csrf
                        <div class="form-group">
                            <label for="block">Pilih blok</label>
                            <select name="block_id" id="block" class="form-control">
                                @foreach ($blocks as $block)
                                    <option value="{{ $block->id }}">{{ $block->code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pyear">Tahun tanam</label>
                            <input type="text" name="pyear" id="pyear" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tcov">Luas block</label>
                            <input type="text" name="tcov" class="form-control" required id="tcov" value="0">
                        </div>
                        <div class="form-group">
                            <label for="popcov">SPH</label>
                            <input type="text" name="pcov" class="form-control" required id="pcov" value="0">
                        </div>
                        <div class="form-group">
                            <label for="pblock">Populasi perblock</label>
                            <input type="text" name="pblock" class="form-control" readonly required id="pblock" value="0">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="create_activity_area" class="btn btn-primary">Tambahkan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        mtcov = document.querySelector("#mtcov");
        mpcov = document.querySelector("#mpcov");
        mpblock = document.querySelector("#mpblock");

        mtcov.addEventListener('keyup', function() {
            mpblock.value = this.value * mpcov.value;
        });
        mpcov.addEventListener('keyup', function() {
            mpblock.value = this.value * mtcov.value;
        });

    </script>

    <script>
        tcov = document.querySelector("#tcov");
        pcov = document.querySelector("#pcov");
        pblock = document.querySelector("#pblock");

        tcov.addEventListener('keyup', function() {
            pblock.value = this.value * pcov.value;
        });
        pcov.addEventListener('keyup', function() {
            pblock.value = this.value * tcov.value;
        });

    </script>
    <script>
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!!$years!!},
                datasets: [{
                    data: {!!$coverages!!},
                    backgroundColor: {!!$colors!!},
                    borderColor: "black",
                    borderWidth: 2
                }]
            },
        });

    </script>
@endsection
