@extends('layouts.app')

@section('title', 'afdelling list')

@section('content-title')
  Daftar Afdelling
@endsection

@section('content')
  <div class="row">
      <div class="col-8">
          <div class="card">
              <table class="table table-hover table-borderless">
                  <thead class="text-muted">
                      <tr>
                          <th>#</th>
                          <th>Kebun</th>
                          <th>Afdelling</th>
                          <th>HK Total</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($afdellings as $key => $afdelling)
                      <tr>
                          <td scope="row">{{ $loop->iteration }}</td>
                          <td>{{ $afdelling->farm }}</td>
                          <td>{{ $afdelling->name }}</td>
                          <td>{{ $afdelling->hk_total }}</td>
                          <td>
                              <button class="btn btn-sm rounded-pill btn-outline-info pl-3 pr-3" data-toggle="modal"
                                  data-target="#edit-afdelling{{$key}}"><i class="nav-icon fas fa-pen"></i>
                              </button>
                              <button class="btn btn-sm rounded-pill btn-outline-danger pl-3 pr-3" data-toggle="modal"
                                  data-target="#delete-afdelling{{$key}}"><i class="nav-icon fas fa-trash"></i>
                              </button>
                          </td>

                          <!-- Modal edit afdelling -->
                          <div class="modal fade" id="edit-afdelling{{$key}}" tabindex="-1" aria-labelledby="edit-afdellingLabel"
                              aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="edit-afdellingLabel">Edit afdelling</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          <form action="{{ route('afdelling.update', ['afdelling' => $afdelling->id]) }}"
                                              method="post">
                                              @csrf
                                              @method('PUT')
                                               <div class="form-group">
                                                   <label for="farm">Farm</label>
                                                   <select name="farm_id" class="form-control">
                                                       @foreach ($farms as $f)
                                                       <option <?php if($f->id == $afdelling->farm_id) echo "selected" ?> value="{{ $f->id }}">{{ $f->name }}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                               <div class="form-group">
                                                   <label for="afdelling">afdelling</label>
                                                   <input type="text" name="afdelling" id="afdelling"
                                                       class="form-control" value="{{ $afdelling->name }}">
                                               </div>
                                               <div class="form-group">
                                                   <label for="hk_total">HK </label>
                                                   <input type="text" name="hk_total" id="hk_total"
                                                       class="form-control" value="{{ $afdelling->hk_total }}">
                                               </div>
                                              <div class="form-group">
                                                  <label for="afdelling">afdelling</label>
                                                  <input type="text" name="afdelling" id="afdelling" class="form-control"
                                                      value="{{ $afdelling->name }}">
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

                          <!-- Modal delete afdelling -->
                          <div class="modal fade" id="delete-afdelling{{$key}}" tabindex="-1" aria-labelledby="delete-afdellingLabel"
                              aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="delete-afdellingLabel">Delete afdelling</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          <form action="{{ route('afdelling.delete', ['afdelling' => $afdelling->id]) }}"
                                              method="post">
                                              @csrf
                                              @method('DELETE')
                                              Are you sure to delete selected afdelling <b>"{{ $afdelling->name }}"</b>?
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
      <div class="col-4">
          <div class="card">
              <div class="card-header">
                  Add afdelling
              </div>
              <div class="card-body">
                  <form action="{{ route('afdelling.store') }}" method="post">
                      @csrf
                      <div class="form-group">
                          <label for="farm">Farm</label>
                          <select name="farm_id" class="form-control">
                              @foreach ($farms as $f)
                              <option value="{{ $f->id }}">{{ $f->name }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="afdelling">afdelling</label>
                          <input type="text" name="afdelling" id="afdelling" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="hk_total">HK </label>
                          <input type="text" name="hk_total" id="hk_total" class="form-control">
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