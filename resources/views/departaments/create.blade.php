@extends('master')

@section('content')
@parent

  <form method="POST" action="{{ route('departaments.store') }}">
    @csrf
    @include('departaments.form')
  </form>

@endsection
