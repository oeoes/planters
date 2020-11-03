@extends('assistant.app')

@section('title', 'Dasbor')

@section('content-title', '')

@section('css')@endsection

@section('breadcumb')@endsection

@section('content')
  <h2>User Page.. halo {{ assistant()->name}}</h2>
  <br>
  <a href="/logout">Logout {{ assistant()->name }} ??</a>
@endsection