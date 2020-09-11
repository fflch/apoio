@extends('master')

@section('content')
@parent

<form method="POST" action="{{ route('areas.update', $area->id) }}">
    @csrf
    @method('PUT')
    @include('areas.form')
  </form>

@endsection
