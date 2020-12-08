@extends('superadmin.layouts.app')

@section('title', 'Detail History RKH - Manual Circle')

@section('content-title')
  Detail History RKH - Manual Circle 
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <!-- The time line -->
                  <div class="timeline">
    
                    @foreach ($fills as $fill)
                    <div class="time-label">
                        <span class="bg-red">{{ date('d M Y', strtotime($fill[0]['created_at'])) }}</span>
                      </div>
                      <div>
                      <i class="fas fa-check bg-blue"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fas fa-clock"></i> {{ $fill[0]['begin'] }} - {{ $fill[0]['ended'] }}</span>
                          <h3 class="timeline-header font-weight-bold">
                              {{ subforeman($block_reference->model::where('block_ref_id', $block_reference->id)->first()->subforeman_id)->name }}
                        </h3>
        
                          <div class="timeline-body">
                            <ul class="list-group">
                                <li class="list-group-item">Capaian luas
                                    <span class="float-right">
                                        {{ $fill[0]['ftarget_coverage'] }} Ha
                                    </span>
                                </li>
                                <li class="list-group-item">Jenis manual circle
                                    <span class="float-right">
                                        {{ $block_reference->model::where('block_ref_id', $block_reference->id)->first()->ingredients_type }}
                                    </span>
                                </li>
                                <li class="list-group-item">Jumlah bahan
                                    <span class="float-right">
                                        {{ $fill[0]['fingredients_amount'] }}
                                    </span>
                                </li>
                                <li class="list-group-item">Catatan
                                    <span class="float-right">
                                        {{ $fill[0]['subforeman_note'] }}
                                    </span>
                                </li>
                              </ul>
                          </div>
                          <div class="timeline-footer">
                            <img src="{{ $fill[0]['image'] }}" width="100%">
                          </div>
                        </div>
                      </div>
                    @endforeach
    
                    <div>
                      <i class="fas fa-clock bg-gray"></i>
                    </div>
                  </div>
                </div>
                <!-- /.col -->
              </div>
            </div>
        </section>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">Tahun tanam
                        <span class="float-right">
                            {{ $block_reference->planting_year }}
                        </span>
                    </li>
                    <li class="list-group-item">Blok
                        <span class="float-right">
                            {{ block($block_reference->block_id) }}
                        </span>
                    </li>
                    <li class="list-group-item">Luas total
                        <span class="float-right">
                            {{ $block_reference->total_coverage }} Ha
                        </span>
                    </li>
                    <li class="list-group-item">Luas populasi
                        <span class="float-right">
                            {{ $block_reference->population_coverage }} Ha
                        </span>
                    </li>
                    <li class="list-group-item">Luas perblock
                        <span class="float-right">
                            {{ $block_reference->population_perblock }} Ha
                        </span>
                    </li>
                  </ul>
            </div>
        </div>
    </div>
</div>
@endsection