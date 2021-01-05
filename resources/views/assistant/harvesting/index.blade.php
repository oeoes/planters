@extends('assistant.layouts.app')

@section('title', 'Daftar Panen')

@section('content-title')
    Daftar panen
@endsection

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm" id="myTable">
                        <thead class="bg-primary">
                            <tr>
                                <td>Tgl panen</td>
                                <td>Blok</td>
                                <td>Janjang</td>
                                <td>BJR</td>
                                <td>Tot. panen</td>
                                <td>Karyawan</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($harvestings as $key => $hvs)
                                @php
                                $employee_harvestings = \DB::table('employee_harvestings')->where('harvest_id',
                                $hvs->id)->get();
                                $fill_harvesting = App\Models\Harvesting\FillHarvesting::where('harvest_id',
                                $hvs->id)->first();
                                $block = App\Models\BlockReference::find($hvs->block_ref_id);
                                $block_id = $block->block_id;
                                @endphp
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($hvs->date)) }}</td>
                                    <td>{{ block($block_id) }}</td>
                                    <td>{{ round($fill_harvesting->total_harvesting / $hvs->bjr, 2) }} </td>
                                    <td>{{ $hvs->bjr }}</td>
                                    <td>{{ $fill_harvesting->total_harvesting }}</td>
                                    <td>
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                            data-target="#exampleModal{{ $key }}">
                                            Karyawan ({{ count($employee_harvestings) }})
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $key }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                @foreach ($employee_harvestings as $emp)
                                                    Nama: {{ $emp->name }} - Total panen: {{ $emp->total_harvesting }}<br />
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">Bagan</div>
                <div class="card-body">
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var ctx = document.getElementById('myChart');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!!$month!!},
                datasets: [{
                    label: 'Total hasil panen',
                    data: {!!$sum!!},
                    backgroundColor: 'blue'
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

    </script>
@endsection
