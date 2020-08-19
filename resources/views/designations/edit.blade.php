@extends('master')

@section('content')
@parent

<form method="POST" action="{{ route('designations.update', $designation->id) }}">
    @csrf
    @method('PUT')
    @include('designations.form')
  </form>

@endsection
