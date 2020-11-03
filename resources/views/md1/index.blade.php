@extends('md1.app')

@section('title', 'Dasbor')

@section('content-title', '')

@section('css')@endsection

@section('breadcumb')@endsection

@section('content')
  <h2>User Page.. halo {{ md1()->name}}</h2>
  <br>
  <a href="/logout">Logout {{ md1()->name }} ??</a>
@endsection