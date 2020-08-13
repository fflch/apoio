@extends('master')

@section('content')
@parent

  <form method="POST" action="{{ route('institutions.store') }}">
    @csrf
    @include('institutions.form')
  </form>

@endsection
