@extends('layouts.app')

@section('title', 'Employees list')

@section('content-title')
  Employees listed
@endsection

@section('modal')

@endsection

@section('content')
  <div class="card col-8">
    <div class="card-body">
      <table class="table table-sm">
        <thead class="bg-primary">
          <tr>
            <th>#</th>
            <th>employee</th>
            {{-- <th>Email</th> --}}
          </tr>
        </thead>
        <tbody>
          @foreach ($employees as $em)
            <tr>
              <td scope="row">{{ $loop->iteration }}</td>
              <td>{{ $em->name }}</td>
              {{-- <td>{{ $em->email }}</td> --}}
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