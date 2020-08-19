@extends('master')

@section('content')
@parent

  <form method="POST" action="{{ route('designations.store') }}">
    @csrf
    @include('designations.form')
  </form>

@endsection
