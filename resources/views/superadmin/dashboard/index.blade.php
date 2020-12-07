@extends('superadmin.layouts.app')

@section('title', 'Super Admin - Dashboard')

@section('content-title')
  Overview (Dummy)
@endsection

@section('content')

<div class="content">
  <div class="container-fluid">
    <h5 class="mb-2 mt-4">Small Box</h5>
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ App\Models\Farm::count() }}</h3>

            <p>Farms</p>
          </div>
          <div class="icon">
            <i class="fas fa-shopping-cart"></i>
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
            <i class="ion ion-stats-bars"></i>
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

            <p>Bloks</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-plus"></i>
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
              <h3 class="card-title">Spraying last 5 years</h3>
              <a href="javascript:void(0);">View Report</a>
            </div>
          </div>
          <div class="card-body">
            <canvas id="myChart" width="400" height="400"></canvas>
          </div>
        </div>
        <!-- /.card -->

        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title">Products</h3>
            <div class="card-tools">
              <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-download"></i>
              </a>
              <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-bars"></i>
              </a>
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
              <thead>
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Sales</th>
                <th>More</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>
                  <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                  Some Product
                </td>
                <td>$13 USD</td>
                <td>
                  <small class="text-success mr-1">
                    <i class="fas fa-arrow-up"></i>
                    12%
                  </small>
                  12,000 Sold
                </td>
                <td>
                  <a href="#" class="text-muted">
                    <i class="fas fa-search"></i>
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                  Another Product
                </td>
                <td>$29 USD</td>
                <td>
                  <small class="text-warning mr-1">
                    <i class="fas fa-arrow-down"></i>
                    0.5%
                  </small>
                  123,234 Sold
                </td>
                <td>
                  <a href="#" class="text-muted">
                    <i class="fas fa-search"></i>
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                  Amazing Product
                </td>
                <td>$1,230 USD</td>
                <td>
                  <small class="text-danger mr-1">
                    <i class="fas fa-arrow-down"></i>
                    3%
                  </small>
                  198 Sold
                </td>
                <td>
                  <a href="#" class="text-muted">
                    <i class="fas fa-search"></i>
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                  Perfect Item
                  <span class="badge bg-danger">NEW</span>
                </td>
                <td>$199 USD</td>
                <td>
                  <small class="text-success mr-1">
                    <i class="fas fa-arrow-up"></i>
                    63%
                  </small>
                  87 Sold
                </td>
                <td>
                  <a href="#" class="text-muted">
                    <i class="fas fa-search"></i>
                  </a>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col-md-6 -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Sales</h3>
              <a href="javascript:void(0);">View Report</a>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex">
              <p class="d-flex flex-column">
                <span class="text-bold text-lg">$18,230.00</span>
                <span>Sales Over Time</span>
              </p>
              <p class="ml-auto d-flex flex-column text-right">
                <span class="text-success">
                  <i class="fas fa-arrow-up"></i> 33.1%
                </span>
                <span class="text-muted">Since last month</span>
              </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
              <canvas id="sales-chart" height="200"></canvas>
            </div>

            <div class="d-flex flex-row justify-content-end">
              <span class="mr-2">
                <i class="fas fa-square text-primary"></i> This year
              </span>

              <span>
                <i class="fas fa-square text-gray"></i> Last year
              </span>
            </div>
          </div>
        </div>
        <!-- /.card -->

        <div class="card">
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
            <!-- /.d-flex -->
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
            <!-- /.d-flex -->
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
            <!-- /.d-flex -->
          </div>
        </div>
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
    </script>
@endsection