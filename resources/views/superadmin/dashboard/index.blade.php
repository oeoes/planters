@extends('superadmin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Overview')

@section('content')

<div class="content">
  <div class="container-fluid">
    <!-- <h5 class="mb-2 mt-4">Small Box</h5> -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ App\Models\Farm::count() }}</h3>

            <p>Farms</p>
          </div>
          <div class="icon">
            <i class="fas fa-tree"></i>
          </div>
          <a href="{{ route('superadmin.farm') }}" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ App\Models\Afdelling::count() }}</h3>

            <p>Afdellings</p>
          </div>
          <div class="icon">
            <i class="fas fa-tractor"></i>
          </div>
          <a href="{{ route('superadmin.afdelling') }}" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ App\Models\Block::count() }}</h3>

            <p>Blocks</p>
          </div>
          <div class="icon">
            <i class="fas fa-th-large"></i>
          </div>
          <a href="{{ route('superadmin.block') }}" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-danger">
          <div class="inner">
            @php
            $today = date('Y-m-d');
            $completed_jobs = [
                  App\Models\Maintain\SprayingType::where('completed', 1)->where('date', $today)->count(),
                  App\Models\Maintain\FertilizerType::where('completed', 1)->where('date', $today)->count(),
                  App\Models\Maintain\CircleType::where('completed', 1)->where('date', $today)->count(),
                  App\Models\Maintain\PruningType::where('completed', 1)->where('date', $today)->count(),
                  App\Models\Maintain\GawanganType::where('completed', 1)->where('date', $today)->count(),
                  App\Models\Maintain\PestControl::where('completed', 1)->where('date', $today)->count(),
                  App\Models\Harvesting\HarvestingType::where('completed', 1)->where('date', $today)->count(),
            ];

            $completed = 0;
            for ($i = 0; $i < count($completed_jobs); $i++) { 
              if ($completed_jobs[$i] > 0) {
                $completed += $completed_jobs[$i];
              }
            }

            $incompleted_jobs = [
                  App\Models\Maintain\SprayingType::where('completed', 0)->where('date', $today)->count(),
                  App\Models\Maintain\FertilizerType::where('completed', 0)->where('date', $today)->count(),
                  App\Models\Maintain\CircleType::where('completed', 0)->where('date', $today)->count(),
                  App\Models\Maintain\PruningType::where('completed', 0)->where('date', $today)->count(),
                  App\Models\Maintain\GawanganType::where('completed', 0)->where('date', $today)->count(),
                  App\Models\Maintain\PestControl::where('completed', 0)->where('date', $today)->count(),
                  App\Models\Harvesting\HarvestingType::where('completed', 0)->where('date', $today)->count(),
            ];

            $incompleted = 0;
            for ($i = 0; $i < count($incompleted_jobs); $i++) { 
              if ($incompleted_jobs[$i] > 0) {
                $incompleted += $incompleted_jobs[$i];
              }
            }

            
            @endphp
            <h3>{{ $completed }} <span style="font-size: 15pt">Of</span> {{ $completed + $incompleted }}</h3>

            <p>RKH completed today</p>
          </div>
          <div class="icon">
            <i class="fas fa-chart-pie"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <div class="d-inline-flex p-2">
                <h3 class="card-title">Spraying last 5 years</h3>
              </div>
              
              <div class="d-inline-flex p-2">
                <select id="" class="form-control form-control-sm rounded-pill pr-4 pl-4">
                    <option value="">Spraying</option>
                    <option value="">Fertilizer</option>
                    <option value="">Circle</option>
                    <option value="">Pruning</option>
                    <option value="">Gawangan</option>
                    <option value="">Pest Control</option>
                    <option value="">Harvesting</option>
                  </select>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="position-relative mb-4">
              <canvas id="myChart" width="400" height="400"></canvas>
            </div>

            <div class="d-flex flex-row justify-content-end">
              <span class="mr-2">
                <i class="fas fa-square text-primary"></i> Total Coverage in Ha
              </span>
            </div>
          </div>
        </div>
        <!-- /.card -->

        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title">Afdelling</h3>
            <div class="card-tools">
              <div class="d-inline-flex p-2">
                <select id="afdellingset" class="form-control form-control-sm rounded-pill pr-4 pl-4">
                    <option value="#">Pilih afdelling</option>
                    @php
                        $afdellings = App\Models\Afdelling::select('id', 'name')->get();
                    @endphp
                    @foreach ($afdellings as $afd)
                        <option value="{{ $afd->id }}">{{ $afd->name }}</option>
                    @endforeach
                  </select>
              </div>
              <div class="d-inline-flex p-2">
                <select id="blockset" class="form-control form-control-sm rounded-pill pr-4 pl-4">
                </select>
              </div>
            </div>
          </div>
          <div class="card-body table-responsive">
            <canvas id="bar" width="400" height="400"></canvas>
          </div>
        </div>
        <!-- /.card -->
      </div>
      
      <!-- /.col-md-6 -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <div class="d-inline-flex p-2">
                <h3 class="card-title">Ketuntasan Pekerjaan</h3>
              </div>
              <div class="d-inline-flex p-2">
                <select id="" class="form-control form-control-sm rounded-pill pr-4 pl-4">
                    <option value="">2015</option>
                    <option value="">2016</option>
                    <option value="">2017</option>
                    <option value="">2018</option>
                    <option value="">2019</option>
                    <option value="">2020</option>
                  </select>
              </div>
              
              <!-- <a href="javascript:void(0);">View Report</a> -->
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex">
              <!-- <p class="d-flex flex-column">
                <span class="text-bold text-lg">$18,230.00</span>
                <span>Sales Over Time</span>
              </p> -->
              <!-- <p class="ml-auto d-flex flex-column text-right">
                <span class="text-success">
                  <i class="fas fa-arrow-up"></i> 33.1%
                </span>
                <span class="text-muted">Since last month</span>
              </p> -->
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
              <canvas id="myChart1" height="200"></canvas>
            </div>

            <!-- <div class="d-flex flex-row justify-content-end">
              <span class="mr-2">
                <i class="fas fa-square text-primary"></i> This year
              </span>

              <span>
                <i class="fas fa-square text-gray"></i> Last year
              </span>
            </div> -->

          </div>
        </div>
        <!-- /.card -->

        <!-- <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title">Online Store Overview</h3>
            <div class="card-tools">
              <a href="#" class="btn btn-sm btn-tool">
                <i class="fas fa-download"></i>
              </a>
              <a href="#" class="btn btn-sm btn-tool">
                <i class="fas fa-bars"></i>
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
              <p class="text-success text-xl">
                <i class="ion ion-ios-refresh-empty"></i>
              </p>
              <p class="d-flex flex-column text-right">
                <span class="font-weight-bold">
                  <i class="ion ion-android-arrow-up text-success"></i> 12%
                </span>
                <span class="text-muted">CONVERSION RATE</span>
              </p>
            </div>
            
            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
              <p class="text-warning text-xl">
                <i class="ion ion-ios-cart-outline"></i>
              </p>
              <p class="d-flex flex-column text-right">
                <span class="font-weight-bold">
                  <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
                </span>
                <span class="text-muted">SALES RATE</span>
              </p>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-0">
              <p class="text-danger text-xl">
                <i class="ion ion-ios-people-outline"></i>
              </p>
              <p class="d-flex flex-column text-right">
                <span class="font-weight-bold">
                  <i class="ion ion-android-arrow-down text-danger"></i> 1%
                </span>
                <span class="text-muted">REGISTRATION RATE</span>
              </p>
            </div>
            
          </div>
        </div> -->
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
@endsection

@section('js')
  {{-- <script src="{{ asset('js/adminLte.js') }}"></script> --}}
  <script>
    console.log(<?= $plantingyear ?>);
    
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
          datasets: [{
            data: [<?= $coverage ?>],
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
            ],
          }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [<?= $plantingyear ?>]
      },
    });

    var ctx1 = document.getElementById('myChart1').getContext('2d');
    var myChart1 = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Spraying', 'Fertilizer', 'Circle', 'Pruning', 'Gawangan', 'Pest control', 'Harvesting'],
            datasets: [{
                label: 'Coverage',
                data: [12, 19, 3, 5, 2, 3, 7],
                backgroundColor: 'rgba(108, 25, 255, 0.2)',
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            },
          {
                label: 'HK',
                data: [5, 8, 3, 2, 6, 3, 8],
                backgroundColor: 'rgba(233, 30, 99, 0.2)',
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
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
     
    $(document).ready(function() {
      $("#afdellingset").change(function() {
        let afdelling_id = this.value;
        $.ajax({
          type: "GET",
          url: '/pyear/list/' + afdelling_id,
          dataType: 'JSON', 
          // data: {
          //     "_token": "{{ csrf_token() }}"
          // },
          success: function(data) {

            label = [];
            current = [];
            total = [];
          
            console.log(current, data, [10, 20, 40]);

            var data = {
              labels: label,
              datasets: [{
                label: "Current coverage",
                backgroundColor: "blue",
                data: [10, 20, 40]
              }, {
                label: "Total coverage",
                backgroundColor: "red",
                data: [50, 60, 80]
              },
              ]
            };

            loadBarChart(data)
          },
          error: function (request, status, error) {
            console.log(request.responseText);
          }
        });
      });
    });

    var ctx2 = document.getElementById("bar").getContext("2d");
    function loadBarChart(data) {
        var myBarChart = new Chart(ctx2, {
          type: 'bar',
          data: data,
          options: {
            barValueSpacing: 20,
            scales: {
              yAxes: [{
                ticks: {
                  min: 0,
                }
              }]
            }
          }
        });
    }

    </script>
@endsection