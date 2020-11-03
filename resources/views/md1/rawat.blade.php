@extends('md1.app')

@section('title', 'Dasbor')

@section('content-title')
  <b>Rawat</b> <small class="text-muted font-weight-lighter" style="font-size: 14pt">Rencana Kerja Harian</small>
@endsection

@section('css')
@endsection

@section('breadcumb')
@endsection

@section('content')
<div class="">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Tambah Rencana Kerja Harian</h3>
    </div>
    <form role="form" method="POST" action="#">
      @csrf
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                <h4 class="font-weight-bold">Ditujukan</h4>
                  <label for="md2">Mandor II</label>
                  <select name="md2" id="md2" class="form-control form-control-sm">
                    <option value="1">Rusli</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <h4 class="font-weight-bold">Area</h4>
                  @php
                  $farms      = App\Models\Farm::all();
                  $afdellings = App\Models\afdelling::all();
                  $farms      = App\Models\Farm::all();
                @endphp
                {{-- <div class="form-group">
                  <label for="farm">Kebun</label>
                  <select name="farm" id="farm" class="form-control form-control-sm">
                    <option value="#">Pilih kebun</option>
                    @foreach ($farms as $farm)
                        <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                    @endforeach
                  </select>
                </div> --}}
                <div class="form-group">
                  <label for="afdelling">Afdelling</label>
                  <select name="afdelling" id="afdelling" class="form-control form-control-sm">
                    <option value="#">Pilih afdelling</option>
                    @foreach ($afdellings as $afdelling)
                        <option value="{{ $afdelling->id }}">{{ $afdelling->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="farm">Blok</label>
                  <select name="farm" id="farm" class="form-control form-control-sm">
                    <option value="#">Pilih Blok</option>
                    @foreach ($farms as $farm)
                        <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="luas">Luas</label>
                  <input type="text" name="luas" id="luas" class="form-control form-control-sm" required>
                  <small class="text-muted">Luas dalam Hektoare</small>
                </div>
                <div class="form-group">
                  <label for="populasi">Populasi</label>
                  <input type="text" name="populasi" id="populasi" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                  <label for="tahun_tanam">Tahun tanam</label>
                  <input type="text" name="tahun_tanam" id="tahun_tanam" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                  <label for="jumlah_karyawan">Jumlah karyawan</label>
                  <input type="text" name="jumlah_karyawan" id="jumlah_karyawan" class="form-control form-control-sm" required>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="rawat">
              <div class="card">
                <div class="card-body">
                  <h4 class="font-weight-bold">Manual</h4>
                  <div class="form-group">
                    <label for="circle">Circle</label>
                    <input type="text" name="circle" id="circle" class="form-control form-control-sm">
                  </div>
                  <div class="form-group">
                    <label for="prunning">Prunning</label>
                    <input type="text" name="prunning" id="prunning" class="form-control form-control-sm">
                  </div>
                  <div class="form-group">
                    <label for="gawangan">Gawangan</label>
                    <input type="text" name="gawangan" id="gawangan" class="form-control form-control-sm">
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <h4 class="font-weight-bold">Pupuk</h4>
                  <div class="form-group">
                    <label for="jenis_pupuk">Jenis pupuk</label>
                    <input type="text" name="jenis_pupuk" id="jenis_pupuk" class="form-control form-control-sm">
                  </div>
                  <div class="form-group">
                    <label for="qty_pupuk">Kuantitas bahan</label>
                    <input type="text" name="qty_pupuk" id="qty_pupuk" class="form-control form-control-sm">
                    <small class="text-muted">Dalam kilogram</small>
                  </div>
                  <div class="form-group">
                    <label for="periode">Periode</label>
                    <input type="text" name="periode" id="periode" class="form-control form-control-sm">
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <h4 class="font-weight-bold">Spraying</h4>
                  <div class="form-group">
                    <label for="jenis_spraying">Jenis pupuk</label>
                    <input type="text" name="jenis_spraying" id="jenis_spraying" class="form-control form-control-sm">
                  </div>
                  <div class="form-group">
                    <label for="qty">Kuantitas bahan</label>
                    <input type="text" name="qty" id="prunning" class="form-control form-control-sm">
                    <small class="text-muted">Dalam liter</small>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('js')
  <script>
    
  </script>
@endsection