@extends('master')

@section('content')

<form method="POST" action="{{ route('institutions.update', $institution->id) }}">
    @csrf
    @method('PUT')
    @include('institutions.form')
  </form>

@endsection
