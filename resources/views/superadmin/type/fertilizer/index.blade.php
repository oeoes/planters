@extends('superadmin.layouts.app')

@section('title', 'RKH - Fertilizer')

@section('content-title')
  RKH - Fertilizer
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
      <div class="card">
          <table id="myTable" class="table table-hover table-borderless table-responsive">
              <thead class="text-muted">
                  <tr>
                      <th>#</th>
                      <th>Mandor utama</th>
                      <th>Tahun tanam</th>
                      <th>Tanggal</th>
                      <th>Total coverage</th>
                      <th>Population coverage</th>
                      <th>Population perblock</th>
                      <th>Block</th>
                      <th>Mandor Bidang</th>
                      <th>Jenis Pekerjaan</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($fertilizers as $key => $fertilizer)
                  <tr>
                      <td scope="row">{{ $key+1 }}</td>
                      <td>{{ $fertilizer->foreman }}</td>
                      <td>{{ $fertilizer->planting_year }}</td>
                      <td>{{ $fertilizer->date }}</td>
                      <td>{{ $fertilizer->total_coverage }}</td>
                      <td>{{ $fertilizer->population_coverage }}</td>
                      <td>{{ $fertilizer->population_perblock }}</td>
                      <td>{{ $fertilizer->block }}</td>
                      <td>{{ $fertilizer->subforeman }}</td>
                      <td>{{ $fertilizer->job_type }}</td>
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
  <div class="col-md-4">
      <div class="card">
        <div class="card-header">
            Add Farm
        </div>
        <div class="card-body">
            <form action="{{ route('superadmin.farm.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="farm">Farm</label>
                    <input type="text" name="farm" id="farm" class="form-control">
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