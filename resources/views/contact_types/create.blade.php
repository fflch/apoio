@extends('master')

@section('content')
@parent

  <form method="POST" action="{{ route('contact_types.store') }}">
    @csrf
    @include('contact_types.form')
  </form>

@endsection
