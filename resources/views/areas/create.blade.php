@extends('master')

@section('content')
@parent

  <form method="POST" action="{{ route('areas.store') }}">
    @csrf
    @include('areas.form')
  </form>

@endsection
