@extends('layouts.app')

@section('title', 'Job Type')

@section('content-title')
  Jenis Pekerjaan
@endsection

@section('modal')

@endsection

@section('content')
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#job_type_modal">
  Add job_type
</button> -->
<div class="row">
  <div class="col-md-8">
      <div class="card">
          <table class="table table-hover table-borderless">
              <thead class="text-muted">
                  <tr>
                      <th>#</th>
                      <th>Job type</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($job_types as $key => $job_type)
                  <tr>
                      <td scope="row">{{ $key+1 }}</td>
                      <td>{{ $job_type->name }}</td>
                      <td>
                        <button class="btn btn-sm rounded-pill btn-outline-info pl-3 pr-3" data-toggle="modal"
                            data-target="#edit-job_type{{$key}}"><i
                                class="nav-icon fas fa-pen"></i>
                        </button>
                        <button class="btn btn-sm rounded-pill btn-outline-danger pl-3 pr-3" data-toggle="modal"
                            data-target="#delete-job_type{{$key}}"><i
                                class="nav-icon fas fa-trash"></i>
                        </button>
                      </td>

                      <!-- Modal edit job_type -->
                      <div class="modal fade" id="edit-job_type{{$key}}" tabindex="-1" aria-labelledby="edit-job_typeLabel"
                          aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="edit-job_typeLabel">Edit job_type</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <form action="{{ route('job_type.update', ['job_type' => $job_type->id]) }}" method="post">
                                          @csrf
                                          @method('PUT')
                                          <div class="form-group">
                                              <label for="job_type">Job Type</label>
                                              <input type="text" name="job_type" id="job_type" class="form-control" value="{{ $job_type->name }}">
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

                      <!-- Modal delete job_type -->
                      <div class="modal fade" id="delete-job_type{{$key}}" tabindex="-1" aria-labelledby="delete-job_typeLabel"
                          aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="delete-job_typeLabel">Delete job_type</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <form action="{{ route('job_type.delete', ['job_type' => $job_type->id]) }}" method="post">
                                          @csrf
                                          @method('DELETE')
                                          Are you sure to delete selected job_type <b>"{{ $job_type->name }}"</b> ?
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
            Add Job Type
        </div>
        <div class="card-body">
            <form action="{{ route('job_type.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="job_type">Job Type</label>
                    <input type="text" name="job_type" id="job_type" class="form-control">
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