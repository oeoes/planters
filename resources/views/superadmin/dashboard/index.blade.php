@extends('superadmin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Overview')

@section('preload')
<!-- preload start -->
<div class="preload-container">
  <div class="preload-text">
    Loading...
  </div>
</div>
<!-- preload end -->
@endsection

@section('content')
<!-- filter start -->
<div class="sort__overlay"></div>
<div class="sort__container animate__animated">
  <div class="sort__header">
    <div class="sort__title">Customize Data</div>
    <div id="sort__close"><i class="fas fa-times"></i></div>
  </div>

  <div class="sort__body mt-3">
    <form action="">
      <div class="form-group">
        <label for="company">Perusahaan</label>
        <select id="company" class="form-control form-control-sm">
          <option>Pilih perusahaan</option>
          @foreach($companies as $company)
          <option value="{{ $company->id }}">{{ $company->company_name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="farm">Kebun</label>
        <select id="farm" class="form-control form-control-sm">
          <option>Pilih kebun</option>
        </select>
      </div>

      <div class="form-group">
        <label for="afdelling">Afdelling</label>
        <select id="afdelling" class="form-control form-control-sm">
          <option>Pilih afdelling</option>
        </select>
      </div>

      <div class="form-group">
        <label for="plant_year">Tahun Tanam</label>
        <input id="plant_year" type="number" class="form-control form-control-sm" placeholder="Tahun tanam">
      </div>
  </div>

  <div class="sort__footer">
    <div class="form-group">
      <button id="filter" class="btn btn-sm btn-outline-primary rounded-pill pl-4 pr-4">Filter</button>
    </div>
  </div>
  </form>
</div>

<div class="sort__btn animate__animated animate__jello">
  <div><i class="fas fa-chart-line"></i></div>
</div>

<!-- filter end -->

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-5">
        <div class="row">

          <div class="col-md-12">
            <div class="card">
              <div class="card-body" style="padding: 10px!important">
                <div class="row">
                  <div class="col-md-3">
                    <small class="text-muted">Perusahaan</small>
                    <div id="gen-company" class="mt-2 font-weight-500 text-primary">-</div>
                  </div>

                  <div class="col-md-3">
                    <small class="text-muted">Kebun</small>
                    <div id="gen-farm" class="mt-2 font-weight-500">-</div>
                  </div>

                  <div class="col-md-3">
                    <small class="text-muted">Afdelling</small>
                    <div id="gen-afdelling" class="mt-2 font-weight-500">-</div>
                  </div>

                  <div class="col-md-3">
                    <small class="text-muted">Tahun Tanam</small>
                    <div id="gen-year" class="mt-2 font-weight-500">-</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="small-box bg-info">
              <div class="inner">
                <div class="d-flex justify-content-between">
                  <small>Agency</small>
                  <small id="info-agency">-</small>
                </div>

                <div class="d-flex justify-content-center">
                  <h3 id="info-farm">0</h3>
                </div>
                <div class="d-flex justify-content-center">
                  <small>Kebun terkelola.</small>
                </div>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-md-6">
            <div class="small-box bg-success">
              <div class="inner">
                <div class="d-flex justify-content-between">
                  <small>Manager Kebun</small>
                  <small id="info-manager">-</small>
                </div>

                <div class="d-flex justify-content-center">
                  <h3 id="info-afdelling">0</h3>
                </div>
                <div class="d-flex justify-content-center">
                  <small>Afdelling terkelola.</small>
                </div>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-md-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <div class="d-flex justify-content-between">
                  <small>Asisten Kebun</small>
                  <small id="info-assistant">-</small>
                </div>

                <div class="d-flex justify-content-center">
                  <h3 id="info-block">0</h3>
                </div>
                <div class="d-flex justify-content-center">
                  <small>Block terkelola.</small>
                </div>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-md-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <div class="d-flex justify-content-between">
                  <small>Mandor</small>
                </div>
                <div class="d-flex justify-content-around">
                  <h3 id="info-foreman">0</h3>
                  <h3 id="info-subforeman">0</h3>
                </div>
                <div class="d-flex justify-content-around">
                  <small>Mandor utama</small>
                  <small>Mandor bidang</small>
                </div>

              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>
      </div>

      <div class="col-md-7">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="text-muted">Ketuntasan Pekerjaan</div>
                <div class="d-flex justify-content-around mt-4">
                  <input type="text" class="knob" id="spraying" data-linecap="round" data-readonly="true" data-thickness=".2" value="0" data-width="70" data-height="75" data-fgColor="#17a2b8">
                  <input type="text" class="knob" id="fertilizer" data-linecap="round" data-readonly="true" data-thickness=".2" value="0" data-width="70" data-height="75" data-fgColor="#4caf50">
                  <input type="text" class="knob" id="circle" data-linecap="round" data-readonly="true" data-thickness=".2" value="0" data-width="70" data-height="75" data-fgColor="#8BC34A">
                  <input type="text" class="knob" id="pruning" data-linecap="round" data-readonly="true" data-thickness=".2" value="0" data-width="70" data-height="75" data-fgColor="#3f51b5">
                  <input type="text" class="knob" id="pcontrol" data-linecap="round" data-readonly="true" data-thickness=".2" value="0" data-width="70" data-height="75" data-fgColor="#E91E63">
                  <input type="text" class="knob" id="gawangan" data-linecap="round" data-readonly="true" data-thickness=".2" value="0" data-width="70" data-height="75" data-fgColor="#009688">
                </div>
                <div class="d-flex justify-content-around text-center mt-2">
                  <small>Spraying</small>
                  <small>Fertilizer</small>
                  <small>Manual Circle</small>
                  <small>Pruning</small>
                  <small>Pest Control</small>
                  <small>Gawangan</small>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="text-muted">Kegiatan Panen</div>
                <div class="row no-gutters text-center">
                  <div class="col-md-3">
                    <div class="h1"><span id="hk-work" class="numscroller" data-min='0' data-max='0' data-delay='1' data-increment='2'>0</span> <small style="font-size: 16px">orang</small></div>
                    <div><small>Karyawan bekerja</small></div>
                  </div>
                  <div class="col-md-3">
                    <div class="h1"><span id="total-kg" class="numscroller" data-min='0' data-max='0' data-delay='5' data-increment='5'>0</span> <small style="font-size: 16px">kg</small></div>
                    <div><small>Produksi panen total</small></div>
                  </div>
                  <div class="col-md-3">
                    <div class="h1"><span id="harvesting" class="numscroller" data-min='0' data-max='0' data-delay='5' data-increment='5'>0</span><small style="font-size: 16px"> %</small></div>
                    <div><small>Ketuntasan panen</small></div>
                  </div>
                  <div class="col-md-3">
                    <div class="h1"><span id="avg-time" class="numscroller" data-min='0' data-max='0' data-delay='5' data-increment='5'>0</span> <small style="font-size: 16px">jam</small></div>
                    <div><small>Rerata lama panen</small></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12 mt-3">
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <div class="text-muted">Hasil Panen</div>
              </div>
              <div class="card-body">
                <canvas id="panen" height="195"></canvas>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <div class="text-muted">Hasil Panen per Afdelling</div>
              </div>
              <div class="card-body">
                <canvas id="kebun" height="195"></canvas>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between">
                  <div class="text-muted">Ketuntasan pekerjaan per Block</div>
                  <div style="width: 30%">
                    <select name="" id="job-completeness-block" class="form-control form-control-sm rounded-pill">
                      <option value="1">Spraying</option>
                      <option value="2">Fertilizer</option>
                      <option value="3">Manual Circle</option>
                      <option value="4">Manual Pruning</option>
                      <option value="5">Pest Control</option>
                      <option value="6">Manual Gawangan</option>
                      <option value="7">Harvesting</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <canvas id="target" height="190"></canvas>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between">
                  <div>Aktifitas Perkebunan</div>
                  <div style="width: 30%">
                    <div class="row">
                      <div class="col-6">
                        <select name="" id="sort-trend-1" class="form-control form-control-sm rounded-pill">
                          <option value="1">Spraying</option>
                          <option value="2">Fertilizer</option>
                          <option value="3">Manual Circle</option>
                          <option value="4">Manual Pruning</option>
                          <option value="5">Pest Control</option>
                          <option value="6">Manual Gawangan</option>
                          <option value="7">Harvesting</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <select name="" id="sort-trend-2" class="form-control form-control-sm rounded-pill">
                          <option value="1">Spraying</option>
                          <option value="2">Fertilizer</option>
                          <option value="3">Manual Circle</option>
                          <option value="4">Manual Pruning</option>
                          <option value="5">Pest Control</option>
                          <option value="6">Manual Gawangan</option>
                          <option value="7">Harvesting</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <canvas id="trend-activities" height="100"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>
@endsection

@section('dashboard-js')
<script src="{{ asset('js/axios.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection