@extends('layouts.app')

@section('title', 'Foreman-2 list')

@section('content-title')
  Foreman-2 listed
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="foremanmodal" tabindex="-1" aria-labelledby="foremanmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="foremanmodalLabel">Add Foreman 2</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('foreman2.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="foreman2">Foreman-2</label>
            <input type="text" name="foreman2" id="foreman2" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
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
<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#foremanmodal">
  Add foreman-2
</button>
  <div class="card col-8">
    <div class="card-body">
      <table class="table table-sm">
        <thead class="bg-primary">
          <tr>
            <th>#</th>
            <th>Foreman</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($foremans2 as $fm)
            <tr>
              <td scope="row">{{ $loop->iteration }}</td>
              <td>{{ $fm->name }}</td>
              <td>{{ $fm->email }}</td>
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