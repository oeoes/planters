@extends('md1.app')

@section('title', 'Dasbor')

@section('content-title', 'Rencana Kerja Harian')

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
            @php
              $farms      = App\Models\Farm::all();
              $afdellings = App\Models\afdelling::all();
              $farms      = App\Models\Farm::all();
            @endphp
            <div class="form-group">
              <label for="farm">Kebun</label>
              <select name="farm" id="farm" class="form-control">
                <option value="#">Pilih kebun</option>
                @foreach ($farms as $farm)
                    <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="afdelling">Afdelling</label>
              <select name="afdelling" id="afdelling" class="form-control">
                <option value="#">Pilih afdelling</option>
                @foreach ($afdellings as $afdelling)
                    <option value="{{ $afdelling->id }}">{{ $afdelling->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="farm">Blok</label>
              <select name="farm" id="farm" class="form-control">
                <option value="#">Pilih Blok</option>
                @foreach ($farms as $farm)
                    <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="luas">Luas</label>
              <input type="text" name="luas" id="luas" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="populasi">Populasi</label>
              <input type="text" name="populasi" id="populasi" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="tahun_tanam">Tahun tanam</label>
              <input type="text" name="tahun_tanam" id="tahun_tanam" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="jumlah_karyawan">Jumlah karyawan</label>
              <input type="text" name="jumlah_karyawan" id="jumlah_karyawan" class="form-control" required>
            </div>
          </div>
          <div class="col-6">
            <label for="">Pekerjaan</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pekerjaan" value="1" id="rawat">
              <label class="form-check-label" for='rawat'>Rawat</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="pekerjaan" value="2" id='panen'>
              <label class="form-check-label" for='panen'>Panen</label>
            </div>
            <div class="rawat">
              <div class="card">
                <div class="card-body">
                  <h4>Manual</h4>
                  <div class="form-group">
                    <label for="circle">Circle</label>
                    <input type="text" name="circle" id="circle" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="prunning">Prunning</label>
                    <input type="text" name="prunning" id="prunning" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="gawangan">Gawangan</label>
                    <input type="text" name="gawangan" id="gawangan" class="form-control">
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <h4>Pupuk</h4>
                  <div class="form-group">
                    <label for="jenis">Jenis pupuk</label>
                    <input type="text" name="jenis" id="jenis" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="qty">Kuantitas bahan</label>
                    <input type="text" name="qty" id="prunning" class="form-control" placeholder="Dalam kilogram">
                  </div>
                  <div class="form-group">
                    <label for="periode">Periode</label>
                    <input type="text" name="gawangan" id="gawangan" class="form-control">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">

          </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('js')
  <script>
    
  </script>
@endsection