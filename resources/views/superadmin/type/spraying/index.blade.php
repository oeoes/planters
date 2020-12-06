@extends('superadmin.layouts.app')

@section('title', 'RKH - Spraying')

@section('content-title')
  RKH - Spraying
@endsection

@section('content')
<div class="card col-md-12">
    <table id="myTable" class="table table-hover" style="font-size:11pt">
        <thead class="text-muted bg-primary">
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Man. utama</th>
                <th>T. Tanam</th>
                <th>Blok</th>
                <th>Tot. cov</th>
                <th>Pop. cov</th>
                <th>SPH</th>
                <th>Man. bidang</th>
                <th>Pekerjaan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- @php $more_data = $sprayings @endphp --}}
            @foreach ($sprayings as $key => $spraying)
            <tr>
                <td scope="row">{{ $key+1 }}</td>
                <td>{{ date('d-m-Y', strtotime($spraying->date))}}</td>
                <td>{{ $spraying->foreman }}</td>
                <td>{{ $spraying->planting_year }}</td>
                <td>{{ $spraying->block }}</td>
                <td>{{ $spraying->total_coverage }} Ha</td>
                <td>{{ $spraying->population_coverage }} Ha</td>
                <td>{{ $spraying->population_perblock }}</td>
                <td>{{ $spraying->subforeman }}</td>
                <td>{{ $spraying->job_type }}</td>
                <td>
                    <a href="{{  route('') }}"></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('js')
  <script>
    
  </script>
@endsection