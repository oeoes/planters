@extends('superadmin.layouts.app')

@section('title', 'RKH - Harvesting')

@section('content-title')
  RKH - Harvesting
@endsection

@section('content')
<a href="{{ route('superadmin.harvesting.history') }}" class="btn btn-default mb-2">History</a>
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
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($harvestings as $key => $harvesting)
                  <tr>
                      <td scope="row">{{ $key+1 }}</td>
                      <td>{{ $harvesting->foreman }}</td>
                      <td>{{ $harvesting->planting_year }}</td>
                      <td>{{ $harvesting->date }}</td>
                      <td>{{ $harvesting->total_coverage }} Ha</td>
                      <td>{{ $harvesting->available_coverage }} Ha</td>
                      <td>{{ $harvesting->population_coverage }} Ha</td>
                      <td>{{ $harvesting->population_perblock }}</td>
                      <td>{{ $harvesting->block }}</td>
                      <td>{{ $harvesting->subforeman }}</td>
                      <td>
                        <a href="" class="btn btn-sm rounded-pill btn-outline-info pl-3 pr-3" data-toggle="modal"
                            data-target="#edit-farm{{$key}}"><i
                                class="nav-icon fas fa-eye"></i>
                        </a>
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