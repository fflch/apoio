@extends('master')

@section('content')
@parent

<form method="POST" action="{{ route('institutions.update', $institution->id) }}">
    @csrf
    @method('PUT')
    @include('institutions.form')
  </form>

@endsection
