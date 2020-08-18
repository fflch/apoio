@extends('master')

@section('content')
@parent

<form method="POST" action="{{ route('departaments.update', $departament->id) }}">
    @csrf
    @method('PUT')
    @include('departaments.form')
  </form>

@endsection
