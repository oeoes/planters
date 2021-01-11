@extends('superadmin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Overview')

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
          <option value="">PT Raja Angsa</option>
        </select>
      </div>

      <div class="form-group">
        <label for="farm">Kebun</label>
        <select id="farm" class="form-control form-control-sm">
          <option value="">Cimory</option>
          <option value="">Rawalumbu</option>
        </select>
      </div>

      <div class="form-group">
        <label for="afdelling">Afdelling</label>
        <select id="afdelling" class="form-control form-control-sm">
          <option value="">Benhill</option>
          <option value="">Rawabebek</option>
        </select>
      </div>

      <div class="form-group">
        <label for="plant_year">Tahun Tanam</label>
        <select id="plant_year" class="form-control form-control-sm">
          <option value="">2015</option>
          <option value="">2016</option>
          <option value="">2017</option>
          <option value="">2018</option>
        </select>
      </div>

    </form>
  </div>

  <div class="sort__footer">
    <div class="form-group">
      <button class="btn btn-sm btn-outline-primary rounded-pill pl-4 pr-4">Filter</button>
    </div>
  </div>
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
                    <div class="mt-2 font-weight-500 text-primary">PT Tobacco Inc</div>
                  </div>

                  <div class="col-md-3">
                    <small class="text-muted">Kebun</small>
                    <div class="mt-2 font-weight-500">Cimory</div>
                  </div>

                  <div class="col-md-3">
                    <small class="text-muted">Afdelling</small>
                    <div class="mt-2 font-weight-500">Benhill</div>
                  </div>

                  <div class="col-md-3">
                    <small class="text-muted">Tahun Tanam</small>
                    <div class="mt-2 font-weight-500">2015</div>
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
                  <small>Sarah</small>
                </div>

                <div class="d-flex justify-content-center">
                  <h3>15</h3>
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
                  <small>Robert Frany</small>
                </div>

                <div class="d-flex justify-content-center">
                  <h3>150</h3>
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
                  <small>Franky</small>
                </div>

                <div class="d-flex justify-content-center">
                  <h3>230</h3>
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
                  <h3>2</h3>
                  <h3>15</h3>
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
                  <input type="text" class="knob" id="spraying" data-linecap="round" data-readonly="true" data-thickness=".2" value="60" data-width="70" data-height="75" data-fgColor="#17a2b8">
                  <input type="text" class="knob" id="fertilizer" data-linecap="round" data-readonly="true" data-thickness=".2" value="77" data-width="70" data-height="75" data-fgColor="#4caf50">
                  <input type="text" class="knob" id="circle" data-linecap="round" data-readonly="true" data-thickness=".2" value="34" data-width="70" data-height="75" data-fgColor="#8BC34A">
                  <input type="text" class="knob" id="pruning" data-linecap="round" data-readonly="true" data-thickness=".2" value="87" data-width="70" data-height="75" data-fgColor="#3f51b5">
                  <input type="text" class="knob" id="pcontrol" data-linecap="round" data-readonly="true" data-thickness=".2" value="66" data-width="70" data-height="75" data-fgColor="#E91E63">
                  <input type="text" class="knob" id="gawangan" data-linecap="round" data-readonly="true" data-thickness=".2" value="88" data-width="70" data-height="75" data-fgColor="#009688">
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
                <div class="d-flex justify-content-around mt-4">
                  <div class="h1"><span class="numscroller" data-min='1' data-max='30' data-delay='1' data-increment='2'>30</span>/<span class="text-muted">50</span> </div>
                  <div class="h1"><span class="numscroller" data-min='1' data-max='250' data-delay='5' data-increment='5'>250</span> kg</div>
                  <div class="h1"><span class="numscroller" data-min='1' data-max='100' data-delay='5' data-increment='5'>100</span>%</div>
                  <!-- <input type="text" class="knob" id="ketuntasan-panen" data-linecap="round" data-readonly="true" data-thickness=".2" value="89" data-width="70" data-height="75" data-fgColor="#ff5722"> -->
                  <div class="h1"><span class="numscroller" data-min='1' data-max='68' data-delay='5' data-increment='5'>68</span> jam</div>
                </div>
                <div class="d-flex justify-content-around">
                  <small>Karyawan bekerja</small>
                  <small>Produksi panen total</small>
                  <small>Ketuntasan panen</small>
                  <small>Rerata lama panen</small>
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
              <!-- <div class="card-header">
                <div class="d-flex justify-content-between">
                  <div>Panen</div>
                  <div style="width: 30%">
                    <select name="" id="" class="form-control form-control-sm rounded-pill">
                      <option value="">Spraying</option>
                      <option value="">Fertilizer</option>
                      <option value="">Manual Circle</option>
                    </select>
                  </div>
                </div>
              </div> -->
              <div class="card-body">
                <div class="text-muted mb-3">Panen</div>
                <canvas id="panen" height="190"></canvas>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="text-muted mb-3">Panen per Kebun</div>
                <canvas id="kebun" height="190"></canvas>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between">
                  <div>Panen</div>
                  <div style="width: 30%">
                    <select name="" id="" class="form-control form-control-sm rounded-pill">
                      <option value="">Spraying</option>
                      <option value="">Fertilizer</option>
                      <option value="">Manual Circle</option>
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
                        <select name="" id="" class="form-control form-control-sm rounded-pill">
                          <option value="">Spraying</option>
                          <option value="">Manual Circle</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <select name="" id="" class="form-control form-control-sm rounded-pill">
                          <option value="">Fertilizer</option>
                          <option value="">Manual Circle</option>
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