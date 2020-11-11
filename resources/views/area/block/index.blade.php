@extends('layouts.app')

@section('title', 'Block list')

@section('content-title')
  Block listed
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="block_modal" tabindex="-1" aria-labelledby="block_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="block_modalLabel">Add block</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('block.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="block">block</label>
            <input type="text" name="block" id="block" class="form-control">
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
<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#block_modal">
  Add block
</button>
  <div class="card col-8">
    <div class="card-body">
      <table class="table table-sm">
        <thead class="bg-primary">
          <tr>
            <th>#</th>
            <th>block</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($blocks as $block)
            <tr>
              <td scope="row">{{ $loop->iteration }}</td>
              <td>{{ $block->name }}</td>
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