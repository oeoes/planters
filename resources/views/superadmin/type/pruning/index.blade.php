@extends('superadmin.layouts.app')

@section('title', 'RKH - Manual Pruning')

@section('content-title')
  RKH - Manual Pruning
@endsection

@section('content')
<a href="{{ route('superadmin.pruning.history') }}" class="btn btn-default mb-2">History</a>
<div class="row">
  <div class="col-md-12">
      <div class="card table-responsive">
          <table id="myTable" class="table table-hover table-borderless">
              <thead class="text-muted bg-primary">
                  <tr>
                      <th>#</th>
                      <th>Mandor utama</th>
                      <th>Tahun tanam</th>
                      <th>Tanggal</th>
                      <th>Total coverage</th>
                      <th>Available coverage</th>
                      <th>Population coverage</th>
                      <th>Population perblock</th>
                      <th>Block</th>
                      <th>Mandor Bidang</th>
                      <th>Jenis Pekerjaan</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($prunings as $key => $pruning)
                  <tr>
                      <td scope="row">{{ $key+1 }}</td>
                      <td>{{ $pruning->foreman }}</td>
                      <td>{{ $pruning->planting_year }}</td>
                      <td>{{ $pruning->date }}</td>
                      <td>{{ $pruning->total_coverage }}</td>
                      <td>{{ $pruning->available_coverage }}</td>
                      <td>{{ $pruning->population_coverage }}</td>
                      <td>{{ $pruning->population_perblock }}</td>
                      <td>{{ $pruning->block }}</td>
                      <td>{{ $pruning->subforeman }}</td>
                      <td>{{ $pruning->job_type }}</td>
                      <td>
                        <button class="btn btn-sm rounded-pill btn-outline-info pl-3 pr-3" data-toggle="modal"
                            data-target="#edit-farm{{$key}}"><i
                                class="nav-icon fas fa-pen"></i>
                        </button>
                        <div class="mb-1"></div>
                        <button class="btn btn-sm rounded-pill btn-outline-danger pl-3 pr-3" data-toggle="modal"
                            data-target="#delete-farm{{$key}}"><i
                                class="nav-icon fas fa-trash"></i>
                        </button>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
</div>
@endsection

@section('js')
  <script>
    
  </script>
@endsection