@extends('superadmin.layouts.app')

@section('title', 'RKH - Manual Pruning')

@section('content-title')
  RKH - Manual Pruning
@endsection

@section('content')
<div class="card col-md-12">
    <table id="myTable" class="table" style="font-size:11pt">
        <thead class="text-muted bg-primary">
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Man. utama</th>
                <th>Tot. cov</th>
                <th>Pop. cov</th>
                <th>SPH</th>
                <th>Man. bidang</th>
                <th>Pekerjaan</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prunings as $key => $pruning)
            @php $reference = App\Models\BlockReference::find($pruning->block_ref_id); @endphp
            <tr>
                <td scope="row">{{ $key+1 }}</td>
                <td>{{ date('d-m-Y', strtotime($pruning->date))}}</td>
                <td>{{ foreman($pruning->foreman_id)->name }}</td>
                <td>{{ $reference->total_coverage }} Ha</td>
                <td>{{ $reference->population_coverage }} Ha</td>
                <td>{{ $reference->population_perblock }}</td>
                <td>{{ subforeman($pruning->subforeman_id)->name }}</td>
                <td>{{ jobtype($reference->jobtype_id) }}</td>
                <td>
                    <a href="{{ route('superadmin.pruning.detail', [$pruning->block_ref_id, $pruning->id]) }}" class="btn btn-default btn-sm">
                        {{ $reference->planting_year }} - {{ block($reference->block_id) }}
                    </a>
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