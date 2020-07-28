@extends('master')

@section('content')

  <form method="POST" action="{{ route('institutions.store') }}">
    @csrf
    @include('institutions.form')
  </form>

@endsection

