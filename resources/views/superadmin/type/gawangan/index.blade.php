@extends('superadmin.layouts.app')

@section('title', 'RKH - Manual Gawangan')

@section('content-title')
  RKH - Manual Gawangan
@endsection

@section('content')
<a href="{{ route('superadmin.gawangan.history') }}" class="btn btn-default mb-2">History</a>
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
                  @foreach ($gawangans as $key => $gawangans)
                  <tr>
                      <td scope="row">{{ $key+1 }}</td>
                      <td>{{ $gawangans->foreman }}</td>
                      <td>{{ $gawangans->planting_year }}</td>
                      <td>{{ $gawangans->date }}</td>
                      <td>{{ $gawangans->total_coverage }}</td>
                      <td>{{ $gawangans->available_coverage }}</td>
                      <td>{{ $gawangans->population_coverage }}</td>
                      <td>{{ $gawangans->population_perblock }}</td>
                      <td>{{ $gawangans->block }}</td>
                      <td>{{ $gawangans->subforeman }}</td>
                      <td>{{ $gawangans->job_type }}</td>
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