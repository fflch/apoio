@extends('master')

@section('content')
@parent

<form method="POST" action="{{ route('roles.update', $role->id) }}">
    @csrf
    @method('PUT')
    @include('roles.form')
  </form>

@endsection
