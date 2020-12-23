@extends('assistant.layouts.app')

@section('title', 'Daftar Kelola Aktivitas')

@section('content-title')
    Daftar Kelola Aktivitas
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Daftar kelola aktivitas
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="bg-primary">
                            <tr>
                                <th>#</th>
                                <th>Blok</th>
                                <th>Tahun tanam</th>
                                <th>Luas area</th>
                                <th>Luas populasi</th>
                                <th>Populasi perblok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($block_static as $static)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ block($static->block_id) }}</td>
                                    <td>{{ $static->planting_year }}</td>
                                    <td>{{ $static->total_coverage }}</td>
                                    <td>{{ $static->population_coverage }}</td>
                                    <td>{{ $static->population_perblock }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Tambah aktivitas area</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('assistant.activities') }}">
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
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
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
@endsection
