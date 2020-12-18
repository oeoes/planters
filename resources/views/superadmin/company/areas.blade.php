@extends('superadmin.layouts.app')

@section('title', 'Daftar area')

@section('content-title')
    <span class="text-muted" style="font-size: 15pt">Daftar area</span> {{ $company }}
@endsection

@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header"> Kebun</div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach ($farms as $farm)
                            <a href="{{ route('superadmin.company.area.afdellings', $farm->id) }}"
                                class="list-group-item list-group-item-action">{{ $farm->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @if (session('afdellings'))
            <div class="col-4">
                <div class="card">
                    <div class="card-header"> Afdelling</div>
                    <div class="card-body">
                        <span> <i class="fa fa-filter" aria-hidden="true"></i> Berdasarkan kebun:
                            {{ App\Models\Farm::where('id', session('farm_id'))->first()->name }}</span>
                        <div class="list-group">
                            @foreach (session('afdellings') as $afd)
                                <a href="#" class="list-group-item list-group-item-action">{{ $afd->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (session('blocks'))
            <div class="col-4">
                <div class="card">
                    <div class="card-header"> Block</div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach ($farms as $farm)
                                <a href="#" class="list-group-item list-group-item-action">{{ $farm->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('js')
    <script>

    </script>
@endsection
