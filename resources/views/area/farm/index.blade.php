@extends('layouts.app')

@section('title', 'Farm list')

@section('content-title')
  Farm listed
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="farm_modal" tabindex="-1" aria-labelledby="farm_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="farm_modalLabel">Add Farm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('farm.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="farm">Farm</label>
            <input type="text" name="farm" id="farm" class="form-control">
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
<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#farm_modal">
  Add farm
</button>
  <div class="card col-8">
    <div class="card-body">
      <table class="table table-sm">
        <thead class="bg-primary">
          <tr>
            <th>#</th>
            <th>Farm</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($farms as $farm)
            <tr>
              <td scope="row">{{ $loop->iteration }}</td>
              <td>{{ $farm->name }}</td>
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