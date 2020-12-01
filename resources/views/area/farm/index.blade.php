@extends('layouts.app')

@section('title', 'PLANTERS - Daftar Kebun')

@section('content-title')
  Daftar Kebun
@endsection

@section('modal')

@endsection

@section('content')
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#farm_modal">
  Add farm
</button> -->
<div class="row">
  <div class="col-md-8">
      <div class="card">
          <table id="myTable" class="table table-hover table-borderless">
              <thead class="text-muted">
                  <tr>
                      <th>#</th>
                      <th>Farm</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($farms as $key => $farm)
                  <tr>
                      <td scope="row">{{ $loop->iteration }}</td>
                      <td>{{ $farm->name }}</td>
                      <td>
                        <button class="btn btn-sm rounded-pill btn-outline-info pl-3 pr-3 mb-2" data-toggle="modal"
                            data-target="#edit-farm{{$key}}"><i
                                class="nav-icon fas fa-pen"></i>
                        </button>
                        <button class="btn btn-sm rounded-pill btn-outline-danger pl-3 pr-3" data-toggle="modal"
                            data-target="#delete-farm{{$key}}"><i
                                class="nav-icon fas fa-trash"></i>
                        </button>
                      </td>

                      <!-- Modal edit farm -->
                      <div class="modal fade" id="edit-farm{{$key}}" tabindex="-1" aria-labelledby="edit-farmLabel"
                          aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="edit-farmLabel">Edit Farm</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <form action="{{ route('farm.update', ['farm' => $farm->id]) }}" method="post">
                                          @csrf
                                          @method('PUT')
                                          <div class="form-group">
                                              <label for="farm">Farm</label>
                                              <input type="text" name="farm" id="farm" class="form-control" value="{{ $farm->name }}">
                                          </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button"
                                          class="btn btn-sm rounded-pill btn-outline-secondary pl-3 pr-3"
                                          data-dismiss="modal">Close</button>
                                      <button type="submit"
                                          class="btn btn-sm rounded-pill btn-outline-primary pl-3 pr-3">Save
                                          changes</button>
                                  </div>
                                  </form>
                              </div>
                          </div>
                      </div>

                      <!-- Modal delete farm -->
                      <div class="modal fade" id="delete-farm{{$key}}" tabindex="-1" aria-labelledby="delete-farmLabel"
                          aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="delete-farmLabel">Delete Farm</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <form action="{{ route('farm.delete', ['farm' => $farm->id]) }}" method="post">
                                          @csrf
                                          @method('DELETE')
                                          Are you sure to delete selected farm <b>"{{ $farm->name }}"</b> ?
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button"
                                          class="btn btn-sm rounded-pill btn-outline-secondary pl-3 pr-3"
                                          data-dismiss="modal">Cancle</button>
                                      <button type="submit"
                                          class="btn btn-sm rounded-pill btn-outline-primary pl-3 pr-3">Yes</button>
                                  </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
  <div class="col-md-4">
      <div class="card">
        <div class="card-header">
            Add Farm
        </div>
        <div class="card-body">
            <form action="{{ route('farm.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="farm">Farm</label>
                    <input type="text" name="farm" id="farm" class="form-control">
                </div>
                <button type="submit" class="btn btn-sm rounded-pill btn-outline-primary pl-3 pr-3">Add</button>
            </form>
        </div>
      </div>
  </div>
</div>
@endsection

@section('js')
  <script>
    
  </script>
@endsection