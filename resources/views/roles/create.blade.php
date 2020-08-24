@extends('master')

@section('content')
@parent

  <form method="POST" action="{{ route('roles.store') }}">
    @csrf
    @include('roles.form')
  </form>

@endsection
