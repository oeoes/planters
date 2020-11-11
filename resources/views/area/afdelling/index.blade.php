@extends('layouts.app')

@section('title', 'afdelling list')

@section('content-title')
  Afdelling listed
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="afdelling_modal" tabindex="-1" aria-labelledby="afdelling_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="afdelling_modalLabel">Add afdelling</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('afdelling.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="afdelling">afdelling</label>
            <input type="text" name="afdelling" id="afdelling" class="form-control">
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
    </div>
  </div>
</div>
@endsection

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#afdelling_modal">
  Add afdelling
</button>
  <div class="card col-8">
    <div class="card-body">
      <table class="table table-sm">
        <thead class="bg-primary">
          <tr>
            <th>#</th>
            <th>afdelling</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($afdellings as $afdelling)
            <tr>
              <td scope="row">{{ $loop->iteration }}</td>
              <td>{{ $afdelling->name }}</td>
              <td></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('js')
  <script>
    
  </script>
@endsection